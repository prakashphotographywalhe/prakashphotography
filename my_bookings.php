<?php
session_start();
include 'db.php';
include 'includes/header.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle cancellation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_id'])) {
    $cancel_id = $_POST['cancel_id'];
    $stmt = $pdo->prepare("UPDATE appointments SET status = 'Cancelled' WHERE id = ? AND user_id = ?");
    $stmt->execute([$cancel_id, $user_id]);
    header("Location: my_bookings.php");
    exit();
}

// Fetch user bookings
$stmt = $pdo->prepare("SELECT id, service, date, time, status FROM appointments WHERE user_id = ? ORDER BY date DESC");
$stmt->execute([$user_id]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-center mb-6">My Bookings</h1>

    <?php if (empty($appointments)): ?>
        <p class="text-center text-gray-500">You have no bookings yet.</p>
    <?php else: ?>
        <table class="w-full border-collapse border border-gray-300 shadow-lg">
            <thead>
                <tr class="bg-gradient-to-r from-green-500 to-blue-600 text-white">
                    <th class="border px-4 py-2">Service</th>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Time</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr class="hover:bg-gray-100 transition">
                        <td class="border px-4 py-2"><?= htmlspecialchars($appointment['service']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($appointment['date']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($appointment['time']) ?></td>
                        <td class="border px-4 py-2 <?= ($appointment['status'] == 'Approved') ? 'text-green-600' : (($appointment['status'] == 'Rejected') ? 'text-red-600' : 'text-gray-600') ?>">
                            <?= htmlspecialchars($appointment['status']) ?>
                        </td>
                        <td class="border px-4 py-2">
                            <?php if ($appointment['status'] !== 'Cancelled' && $appointment['status'] !== 'Rejected'): ?>
                                <form method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                    <input type="hidden" name="cancel_id" value="<?= $appointment['id'] ?>">
                                    <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-700">Cancel</button>
                                </form>
                            <?php else: ?>
                                <span class="text-gray-400">N/A</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>

