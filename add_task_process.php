<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];
    $user_id = $_SESSION['user_id'] ?? null;

    if (!empty($name) && !empty($user_id)) {
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, name, description, deadline, priority) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$user_id, $name, $description, $deadline, $priority])) {
            header('Location: dashboard.php?success=1');
            exit;
        } else {
            $error = $stmt->errorInfo();
            die("Database error: " . $error[2]);
        }
    } else {
        die("Missing required fields.");
    }
} else {
    die("Invalid request.");
}
