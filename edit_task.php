<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';

$task_id = $_GET['id'] ?? null;

if (!$task_id) {
    header("Location: dashboard.php");
    exit;
}

// টাস্ক ফেচ করো
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
$stmt->execute([$task_id, $_SESSION['user_id']]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    echo "Task not found or unauthorized access.";
    exit;
}

// টাস্ক আপডেট করো
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $deadline = $_POST['deadline'];

    $stmt = $pdo->prepare("UPDATE tasks SET name = ?, description = ?, deadline = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
    $stmt->execute([$name, $description, $deadline, $task_id, $_SESSION['user_id']]);

    header("Location: dashboard.php");
    exit;
}
?>

<?php require_once '../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/addTask.css">
</head>
<body>
<main class="add_task_form_main_container">
<div class="add_task_form_container">
    <h1>Edit Task</h1>
    <form method="POST">
        <label>Task Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($task['name']) ?>" required>

        <label>Description:</label>
        <textarea name="description" rows="5"><?= htmlspecialchars($task['description']) ?></textarea>

        <!-- <label>Deadline:</label>
        <input type="datetime-local" name="deadline" value="<?= date('Y-m-d\TH:i', strtotime($task['deadline'])) ?>" required> -->

        <button type="submit">Update Task</button>
    </form>
</div>
</main>
<script src="../assets/script.js"></script>
<script src="../assets/js/addTask.js"></script>
<?php require_once '../includes/footer.php'; ?>

</body>
</html>