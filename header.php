<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do App</title>
    <link rel="stylesheet" href="../assets/style.css">
        <!--* <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Web Icon Link>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
</head>
<body>
<main>
    <header>
        <h1>Welcome, <?= htmlspecialchars($_SESSION['name']) ?>!</h1>
        <nav>
            <a href="#"><i class="ri-menu-line header_menu"></i></a>
            <a href="dashboard.php"><i class="ri-dashboard-line"></i> Dashboard</a>
            <a href="add_task.php"><i class="ri-menu-add-line"></i> Add Task</a>
            <a href="../tasks/about.html"><i class="ri-information-line"></i> About</a>
            <a href="../tasks/contact.html"><i class="ri-contacts-line"></i> Contact</a>
            <a href="../auth/logout.php"><i class="ri-logout-circle-r-line logout"></i></a>
        </nav>
    </header>
</main>