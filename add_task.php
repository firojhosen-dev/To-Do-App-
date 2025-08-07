<?php
require_once '../includes/auth_check.php';
require_once '../includes/header.php';

?>

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
    <h1>Add Your New Task</h1>
    <form action="add_task_process.php" method="post">
            <label class="form_item_label" for="name">Name:</label>
            <input class="form_item" type="text" name="name" placeholder="Task Name" required><br>
            <label class="form_item_label" for="deadline">Deadline:</label>
            <input class="form_item" type="date" name="deadline" required><br>
            <label class="form_item_label" for="priority">Priority:</label>
            <select class="form_item" name="priority" required>
                <option value="Low">Low</option>
                <option value="Medium" selected>Medium</option>
                <option value="High">High</option>
            </select>
            <label class="form_item_label" for="description">Task Description:</label>
            <textarea class="form_item" name="description" placeholder="Task Description" rows="5" required></textarea>
            <button class="add_task_submit_button" type="submit">Add Task</button>
    </form>
</div>
</main>
<script src="../assets/script.js"></script>
<script src="../assets/js/addTask.js"></script>
<?php require_once '../includes/footer.php'; ?>

</body>
</html>