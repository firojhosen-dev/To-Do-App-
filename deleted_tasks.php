<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';
require_once '../includes/header.php';

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? AND is_deleted = 1 ORDER BY deleted_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>🗑️ Deleted Tasks</h2>
<div class="task-grid">
    <?php foreach ($tasks as $task): ?>
        <div class="task-card deleted">
            <h3><?= htmlspecialchars($task['name']) ?></h3>
            <p><strong>Deleted At:</strong> <?= htmlspecialchars($task['deleted_at']) ?></p>
            <p><strong>Word Count:</strong> <?= str_word_count(strip_tags($task['description'])) ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once '../includes/footer.php'; ?>
