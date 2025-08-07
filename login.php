<?php
require_once '../config/db.php';
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        header("Location: ../tasks/dashboard.php");
        exit();
    } else {
        $errors[] = "Invalid email or password.";
    }
}
?>
<?php if (!empty($errors)): ?>
    <div class="error">
        <?php foreach ($errors as $e) echo "<p>$e</p>"; ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['registered'])): ?>
    <div class="success">Registration successful! Please login.</div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--?<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Page Title>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
    <title>Login | To-Do App</title>
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
            <h1>Welcome back!</h1>
            <p>Simplify your workflow and boost your productivity<br> with <strong>To-Do App</strong>. Get started for free.</p>
            <form method="POST">
                <input class="input-field" type="email" name="email" placeholder="Email" required>
                <div class="password-wrapper">
                    <input class="input-field" type="password" name="password" id="password" placeholder="Password" class="input-field" required>
                    <span id="togglePassword" class="toggle-password">🙈</span>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
                <button class="input-field" type="submit">Login</button>
                <div class="divider"><span>or continue with</span></div>
                <div class="social-buttons">
                    <a href="#"><i class="ri-google-fill"></i></a>
                    <a href="#"><i class="ri-apple-line"></i></a>
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                </div>
                <p class="register-text">Not a member? <a href="register.php">Register now</a></p>
            </form>
        </div>
        <div class="auth-right">
            <div class="illustration">
                <img src="../img/LoginImage.png" alt="Illustration" />
                <p>Make your work easier and organized<br><strong>with To-Do App</strong></p>
            </div>
        </div>
    </div>
</main>
<!--?<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<JavaScript File>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
<script src="../assets/js/login_register.js"></script>
<?php require_once '../includes/footer.php'; ?>

</body>
</html>
