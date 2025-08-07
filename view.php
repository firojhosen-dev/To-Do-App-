<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';
require_once '../includes/header.php';

if (!isset($_GET['id'])) {
    echo "<p>Invalid task ID</p>";
    exit;
}

$task_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ? AND is_deleted = 0");
$stmt->execute([$task_id, $_SESSION['user_id']]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    echo "<p>Task not found or deleted.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task View</title>
    <!--* <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Web Icon Link>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
</head>
<body>
<div class="task-view-container">
    <h2><?= htmlspecialchars($task['name']) ?></h2>
    <p><strong>Deadline:</strong> <?= htmlspecialchars($task['deadline']) ?></p>
    <p><strong>Description:</strong></p>
    <p><?= nl2br(htmlspecialchars($task['description'])) ?></p>
    <p><strong>Status:</strong> <?= $task['is_completed'] ? '✅ Completed' : '⏳ Pending' ?></p>

    <div class="task-actions">
        <a href="edit_task.php?id=<?= $task['id'] ?>" class="btn"><i class="icon_size ri-indent-decrease"></i><br> Edit</a>
        <a href="delete_task.php?id=<?= $task['id'] ?>" class="btn" onclick="return confirm('Are you sure to delete this task?');"><i class=" icon_size ri-delete-bin-line"></i><br> Delete</a>
        <a href="download_task.php?id=<?= $task['id'] ?>" class="btn"><i class="icon_size ri-save-line"></i><br> Download</a>
        <a href="dashboard.php?id=<?= $task['id'] ?>" class="btn"><i class="icon_size ri-logout-circle-line"></i><br> Dashboard</a>

    </div>
</div>
<?php require_once '../includes/footer.php'; ?>
</body>
</html>