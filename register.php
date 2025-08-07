<?php
require_once '../config/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm  = trim($_POST['confirm_password']);

    if (empty($name) || empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    } elseif ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $errors[] = "Email already registered.";
        } else {
            // Insert user
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashed]);

            header("Location: login.php?registered=1");
            exit();
        }
    }
}
?>
<?php if (!empty($errors)): ?>
    <div class="error">
        <?php foreach ($errors as $e) echo "<p>$e</p>"; ?>
    </div>
            <?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--?<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Page Title>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
    <title>Register | To-Do App</title>
    <!--?<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Favicon Icon>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
    <link rel="shortcut icon" href="../img/CompanyLogo.png" type="image/x-icon">
    <!--?<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Icon>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <!--?<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Stylesheet>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
    <link rel="stylesheet" href="../assets/css/login_register.css">
</head>
<body>
<main>
    <div class="auth-container">
        <div class="auth-left">
            <h1>Create your account</h1>
            <p>Start simplifying your workflow with <strong>Tuga's App</strong>.</p>
            <form method="POST">
                <input class="input-field" type="text" name="name" placeholder="Full Name" required>
                <input class="input-field" type="email" name="email" placeholder="Email Address" required>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password" placeholder="Password" class="input-field" required>
                    <span id="togglePassword" class="toggle-password">🙈</span>
                </div>
                <div class="password-wrapper">
                    <input type="password" name="confirm_password" id="password" placeholder="Confirm Password" class="input-field" required>
                    <span id="togglePassword" class="toggle-password">🙈</span>
                </div>
                <button type="submit">Register</button>
                <div class="divider"><span>or continue with</span></div>
                <div class="social-buttons">
                    <a href="#"><i class="ri-google-fill"></i></a>
                    <a href="#"><i class="ri-apple-line"></i></a>
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                </div>
                <p class="register-text">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
        <div class="auth-right">
            <div class="illustration">
                <img src="../img/RegisterImage.png" alt="Illustration" />
                <p>Make your work easier and organized<br><strong>with To-Do App</strong></p>
            </div>
        </div>
    </div>
</main>
<!--?<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<JavaScript File Link>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
<script src="../assets/js/login_register.js"></script>
<?php require_once '../includes/footer.php'; ?>
</body>
</html>
