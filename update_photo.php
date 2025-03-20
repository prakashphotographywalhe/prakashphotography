<?php
include 'db.php';
session_start();

// Ensure admin access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Check if photo_id is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['photo_id'])) {
    $photo_id = $_POST['photo_id'];

    // Fetch the photo details
    $stmt = $pdo->prepare("SELECT image_url FROM photos WHERE id = ?");
    $stmt->execute([$photo_id]);
    $photo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($photo) {
        $imagePath = $photo['image_url'];

        // Delete the photo from the database
        $deleteStmt = $pdo->prepare("DELETE FROM photos WHERE id = ?");
        $deleteStmt->execute([$photo_id]);

        // Delete the actual image file
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $_SESSION['success'] = "Photo deleted successfully!";
    } else {
        $_SESSION['error'] = "Photo not found.";
    }
}

header("Location: admin.php");
exit();
?>
