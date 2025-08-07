<?php
session_start();

// Redirect to dashboard if logged in
if (isset($_SESSION['user_id'])) {
    header("Location: tasks/dashboard.php");
    exit();
} else {
    header("Location: auth/login.php");
    exit();
}
