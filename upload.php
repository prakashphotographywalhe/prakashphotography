<?php
include 'includes/header.php';
include 'db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set maximum file size in bytes (15MB)
$maxFileSize = 15 * 1024 * 1024;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    // Check if the file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'assets/images/';
        
        // Ensure the upload directory exists and is writable
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
            die("<p class='text-red-500 text-center'>Failed to create upload directory.</p>");
        }

        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $fileSize = $_FILES['image']['size'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Validate file type and size
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "<p class='text-red-500 text-center'>Invalid file type. Only JPG, PNG, and GIF are allowed.</p>";
            exit;
        }

        if ($fileSize > $maxFileSize) {
            echo "<p class='text-red-500 text-center'>File size exceeds 15MB limit.</p>";
            exit;
        }

        // Generate a unique file name to prevent overwriting
        $newFileName = uniqid('img_', true) . '.' . $fileExtension;
        $uploadFile = $uploadDir . $newFileName;

        // Move the uploaded file
        if (move_uploaded_file($fileTmpPath, $uploadFile)) {
            $image_url = $uploadFile;
        } else {
            echo "<p class='text-red-500 text-center'>Error uploading file.</p>";
            exit;
        }
    } else {
        echo "<p class='text-red-500 text-center'>No file uploaded or file upload error.</p>";
        exit;
    }

    // Insert the photo into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO photos (title, description, image_url) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $image_url]);
        echo "<p class='text-green-500 text-center'>Photo uploaded successfully!</p>";
    } catch (PDOException $e) {
        echo "<p class='text-red-500 text-center'>Database error: " . $e->getMessage() . "</p>";
    }
}
?>

<main class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-center mb-8">Upload Photo</h1>
    <form method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea id="description" name="description" class="w-full px-4 py-2 border rounded-lg" required></textarea>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700">Upload Image (Max: 15MB)</label>
            <input type="file" id="image" name="image" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Upload Photo</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>
