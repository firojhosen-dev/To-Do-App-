<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';

// Set headers to force download CSV file
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=tasks_export_' . date('Y-m-d') . '.csv');

// Open PHP output stream for writing CSV data
$output = fopen('php://output', 'w');

// Write the CSV column headers
fputcsv($output, ['ID', 'Task Name', 'Description', 'Deadline', 'Priority', 'Status']);

// Fetch user tasks (excluding deleted)
$stmt = $pdo->prepare("SELECT id, name, description, deadline, priority, is_completed FROM tasks WHERE user_id = ? AND is_deleted = 0 ORDER BY deadline ASC");
$stmt->execute([$_SESSION['user_id']]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Loop through tasks and write rows to CSV
foreach ($tasks as $task) {
    $status = $task['is_completed'] ? 'Completed' : 'Pending';

    // Strip tags from description to keep CSV clean
    $cleanDescription = strip_tags($task['description']);

    fputcsv($output, [
        $task['id'],
        $task['name'],
        $cleanDescription,
        $task['deadline'],
        $task['priority'],
        $status
    ]);
}

// Close output stream
fclose($output);
exit();
?>
