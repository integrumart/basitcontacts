<?php
require_once 'config.php';
requireLogin();

// Get contact ID
$contact_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($contact_id > 0) {
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ? AND user_id = ?");
        $stmt->execute([$contact_id, $_SESSION['user_id']]);
    } catch(PDOException $e) {
        // Log error for debugging
        error_log("Error deleting contact: " . $e->getMessage());
        // Redirect to dashboard with error parameter
        header("Location: dashboard.php?error=delete_failed");
        exit();
    }
}

header("Location: dashboard.php");
exit();
?>
