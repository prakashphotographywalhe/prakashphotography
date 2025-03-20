<?php
include 'includes/header.php';
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p class='text-red-500 text-center'>Please <a href='login.php' class='text-blue-500'>log in</a> to book a slot.</p>";
    exit;
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service = htmlspecialchars($_POST['service']);
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Validate if date & time are in the future
    $selectedDateTime = strtotime("$date $time");
    $currentDateTime = time();

    if ($selectedDateTime <= $currentDateTime) {
        $error = "Please select a future date and time.";
    } else {
        // Insert booking
        $stmt = $pdo->prepare("INSERT INTO appointments (user_id, service, date, time) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$_SESSION['user_id'], $service, $date, $time])) {
            $success = "Booking successful!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<main class="container mx-auto px-6 py-8">
    <h2 class="text-3xl font-bold mb-6 text-center">Book a Slot</h2>

    <?php if (!empty($error)): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="max-w-lg mx-auto bg-white p-6 shadow-lg rounded">
        <div class="mb-4">
            <label class="block text-gray-700">Select Service</label>
            <select name="service" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-400">
                <option value="Wedding">Wedding</option>
                <option value="Photoshoot">Photoshoot</option>
                <option value="Portrait">Portrait</option>
                <option value="Product Shoot">Product Shoot</option>
                <option value="Pre-Wedding">Pre-Wedding</option>
                <option value="Maternity">Maternity</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Select Date</label>
            <input type="date" name="date" required
                   class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-400"
                   min="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Select Time</label>
            <input type="time" name="time" required
                   class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
            Book Now
        </button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>
