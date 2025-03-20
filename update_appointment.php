<?php
session_start();
include 'db.php';

// Ensure admin access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($appointment_id && in_array($action, ['approve', 'reject'])) {
        try {
            if ($action === 'approve') {
                // Approve the appointment
                $stmt = $pdo->prepare("UPDATE appointments SET status = 'Approved' WHERE id = :id");
                $stmt->execute(['id' => $appointment_id]);
                $_SESSION['success_message'] = "Appointment approved successfully.";
            } elseif ($action === 'reject') {
                // Delete the rejected appointment
                $stmt = $pdo->prepare("DELETE FROM appointments WHERE id = :id");
                $stmt->execute(['id' => $appointment_id]);
                $_SESSION['success_message'] = "Rejected appointment deleted successfully.";
            }
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Error updating appointment: " . $e->getMessage();
        }
    } else {
        $_SESSION['error_message'] = "Invalid request.";
    }
}

header("Location: admin.php");
exit();
?>
