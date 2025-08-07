<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$task_id = $_GET['id'];

// টাস্কটি ইউজারের কি না যাচাই করে soft delete করো
$stmt = $pdo->prepare("UPDATE tasks SET is_deleted = 1, updated_at = NOW() WHERE id = ? AND user_id = ?");
$stmt->execute([$task_id, $_SESSION['user_id']]);

header("Location: dashboard.php");
exit;
