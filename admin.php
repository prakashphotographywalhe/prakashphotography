<?php
include 'db.php';
include 'includes/header.php';

// Ensure admin access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    
    $targetDir = "assets/images/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    $fileName = basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . uniqid() . '_' . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Validate image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false && 
        in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif']) && 
        $_FILES["image"]["size"] <= 15000000) { // 15MB limit
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $stmt = $pdo->prepare("INSERT INTO photos (title, description, image_url, uploaded_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$title, $description, $targetFile]);
            header("Location: admin.php"); // Refresh page
            exit();
        }
    }
}

// Fetch appointments
$stmt = $pdo->query("SELECT appointments.id, users.name, appointments.service, appointments.date, appointments.time, appointments.status 
    FROM appointments JOIN users ON appointments.user_id = users.id ORDER BY appointments.date DESC");
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch photos
$photoStmt = $pdo->query("SELECT * FROM photos ORDER BY uploaded_at DESC");
$photos = $photoStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-center mb-8">Admin Dashboard</h1>

    <!-- Appointment Management Section -->
    <h2 class="text-2xl font-semibold mb-4">Appointments</h2>
    <?php if (empty($appointments)): ?>
        <p class="text-center text-gray-500">No appointments available.</p>
    <?php else: ?>
        <table class="w-full border-collapse border border-gray-300 shadow-lg mb-8">
            <thead>
                <tr class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">User</th>
                    <th class="border px-4 py-2">Service</th>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Time</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr class="hover:bg-gray-100 transition">
                        <td class="border px-4 py-2"><?= htmlspecialchars($appointment['id']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($appointment['name']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($appointment['service']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($appointment['date']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($appointment['time']) ?></td>
                        <td class="border px-4 py-2 text-center">
                            <?php if ($appointment['status'] === 'Pending'): ?>
                                <span class="bg-yellow-400 text-white px-2 py-1 rounded">Pending</span>
                            <?php elseif ($appointment['status'] === 'Approved'): ?>
                                <span class="bg-green-500 text-white px-2 py-1 rounded">Approved</span>
                            <?php else: ?>
                                <span class="bg-red-500 text-white px-2 py-1 rounded">Rejected</span>
                            <?php endif; ?>
                        </td>
                        <td class="border px-4 py-2">
                            <form method="POST" action="update_appointment.php" onsubmit="return confirmAction(event)">
                                <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($appointment['id']) ?>">
                                <button name="action" value="approve" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">✔ Approve</button>
                                <button name="action" value="reject" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">✖ Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Image Upload Section -->
    <h2 class="text-2xl font-semibold mb-4">Upload New Photo</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="mb-8 bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
            <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea name="description" id="description" class="w-full border rounded px-3 py-2" rows="3"></textarea>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-semibold mb-2">Select Image</label>
            <input type="file" name="image" id="image" class="w-full" accept="image/*" required>
            <p class="text-sm text-gray-500 mt-1">Max size: 15MB. Formats: JPG, PNG, GIF</p>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Upload Photo</button>
    </form>

    <!-- Photo Management Section -->
    <h2 class="text-2xl font-semibold mb-4">Photo Management</h2>
    <?php if (empty($photos)): ?>
        <p class="text-center text-gray-500">No photos uploaded yet.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php foreach ($photos as $photo): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="<?= htmlspecialchars($photo['image_url']) ?>" 
                         alt="<?= htmlspecialchars($photo['title']) ?>" 
                         class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300"
                         loading="lazy">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold"><?= htmlspecialchars($photo['title']) ?></h3>
                        <p class="text-gray-600"><?= nl2br(htmlspecialchars($photo['description'])) ?></p>
                        <p class="text-sm text-gray-500">Uploaded: <?= htmlspecialchars($photo['uploaded_at']) ?></p>

                        <form method="POST" action="update_photo.php" onsubmit="return confirmPhotoAction(event)">
                            <input type="hidden" name="photo_id" value="<?= htmlspecialchars($photo['id']) ?>">
                 
                            <button name="action" value="delete" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 mt-2">🗑 Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<script>
function confirmAction(event) {
    const action = event.submitter.value;
    return confirm(`Are you sure you want to ${action} this appointment?`);
}

function confirmPhotoAction(event) {
    const action = event.submitter.value;
    return confirm(`Are you sure you want to ${action} this photo?`);
}
</script>

<?php include 'includes/footer.php'; ?>
