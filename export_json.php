<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';

// Fetch tasks
$stmt = $pdo->prepare("SELECT id, name, description, deadline, priority, is_completed FROM tasks WHERE user_id = ? AND is_deleted = 0 ORDER BY deadline ASC");
$stmt->execute([$_SESSION['user_id']]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Set header for JSON download
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="tasks_export_' . date('Y-m-d') . '.json"');

// Clean description from HTML tags
foreach ($tasks as &$task) {
    $task['description'] = strip_tags($task['description']);
    $task['status'] = $task['is_completed'] ? 'Completed' : 'Pending';
    unset($task['is_completed']); // Optional: remove original field
}

echo json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
exit;
?>
