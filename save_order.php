<?php
require_once '../config/db.php';
require_once '../includes/auth_check.php';

$data = json_decode(file_get_contents("php://input"), true);
$order = $data['order'] ?? [];

foreach ($order as $position => $id) {
    $stmt = $pdo->prepare("UPDATE tasks SET task_order = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$position, $id, $_SESSION['user_id']]);
}
