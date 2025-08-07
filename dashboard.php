<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';
require_once '../includes/header.php';


// 🟡 Get Search, Sort & Priority Inputs
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'deadline_asc';
$priority = $_GET['priority'] ?? '';

// 🟡 Base Query
$query = "SELECT * FROM tasks WHERE user_id = ? AND is_deleted = 0";
$params = [$_SESSION['user_id']];

// 🔍 Search Filter
if (!empty($search)) {
    $query .= " AND (name LIKE ? OR description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// 🏷️ Priority Filter
if (!empty($priority)) {
    $query .= " AND priority = ?";
    $params[] = $priority;
}

// 🔁 Sort Order
switch ($sort) {
    case 'az':
        $query .= " ORDER BY name ASC";
        break;
    case 'za':
        $query .= " ORDER BY name DESC";
        break;
    case 'deadline_desc':
        $query .= " ORDER BY deadline DESC";
        break;
    default:
        $query .= " ORDER BY deadline ASC";
        break;
}

// 🔄 Execute Query
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>
    
</body>
</html>
<!-- 🔍 Search + Sort + Priority Filter -->
<form class="bottom" method="get">
    <input class="dashboard_button task_search" type="text" name="search" placeholder="Search tasks..." value="<?= htmlspecialchars($search) ?>" />
    <select class="dashboard_button cursor" name="sort" >
        <option value="az" <?= $sort == 'az' ? 'selected' : '' ?>>A-Z</option>
        <option value="za" <?= $sort == 'za' ? 'selected' : '' ?>>Z-A</option>
        <option value="deadline_asc" <?= $sort == 'deadline_asc' ? 'selected' : '' ?>>Deadline ↑</option>
        <option value="deadline_desc" <?= $sort == 'deadline_desc' ? 'selected' : '' ?>>Deadline ↓</option>
    </select>
    <select class="dashboard_button cursor" name="priority">
        <option value="">All Priorities</option>
        <option value="High" <?= $priority == 'High' ? 'selected' : '' ?>>High</option>
        <option value="Medium" <?= $priority == 'Medium' ? 'selected' : '' ?>>Medium</option>
        <option value="Low" <?= $priority == 'Low' ? 'selected' : '' ?>>Low</option>
    </select>
    <button class="dashboard_button cursor search_apply" type="submit" >Apply</button>
</form>

<!-- 🧩 Task List Container -->
<div id="task-list" class="task-grid" style="display:flex; flex-wrap:wrap; gap:20px;">
    <?php if (count($tasks) > 0): ?>
        <?php foreach ($tasks as $task): ?>
            <div class="task-card" draggable="true" data-id="<?= $task['id'] ?>" style="width: 280px; height: 200px; background:#fff; padding:15px; border-radius:10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden; display: flex; flex-direction: column; justify-content: space-between;">
                <a href="view.php?id=<?= $task['id'] ?>" style="color: inherit; text-decoration: none; flex-grow: 1;">
                    <h3 style="margin-bottom: 8px; font-size: 1.25rem;"><?= htmlspecialchars($task['name']) ?></h3>
                    <p style="margin: 0; font-size: 0.9rem;"><strong>Deadline:</strong> <?= htmlspecialchars($task['deadline']) ?></p>
                    <p style="margin: 0; font-size: 0.9rem;">
                        <strong>Word Count:</strong> <?= str_word_count(strip_tags($task['description'])) ?>
                    </p>
                    <p style="margin-top: 10px; font-size: 0.9rem;">
                        <strong>Priority:</strong>
                        <span class="priority-badge <?= strtolower($task['priority']) ?>">
                            <?= htmlspecialchars($task['priority']) ?>
                        </span>
                    </p>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tasks found. <a href="add_task.php">Add one now</a>.</p>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>

<!-- 🔗 JS for Drag & Drop -->
<script src="../assets/script.js"></script>

<!-- ✅ Priority Color Badge CSS -->
<style>
    /* Priority badge styling */
    .priority-badge {
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: bold;
        color: white;
    }
    .priority-badge.high {
        background-color: #e74c3c; /* Red for High */
    }
    .priority-badge.medium {
        background-color: #f39c12; /* Orange for Medium */
    }
    .priority-badge.low {
        background-color: #27ae60; /* Green for Low */
    }
</style>
