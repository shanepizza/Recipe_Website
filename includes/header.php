<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// First visit: initialize loggedIn. The isset() guard keeps an
// existing login from being reset on every page load.
if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css files/header.css">
    <link rel="stylesheet" href="../css files/layout-debug.css">
    <link rel="stylesheet" href="../includes/Login_page/login_modal.css">
    <script src="../scripts/asset-checker.js"></script>
    <script src="../includes/Login_page/login_modal.js" defer></script>
    
    <title>Header File</title>
</head>

<body>
    <?php include __DIR__ . '\login_modal.php'; ?>
    <header class="header">
        <nav>
            <!-- Navigation content goes here -->
             <div class="logo-div">
                <!-- Logo goes here -->
                 <a href="../Web_pages/index.php">
                    <!-- This is meant to be replaced once I have a proper logo -->
                    <img class="logo-svg logo" src="../images/landscape-placeholder.svg" alt="Logo">
                 </a>
             </div>
            <div class="search-bar">
                <!-- Search bar goes here -->
                 <form action="" method="get">
                     
                    <input type="text" name="search" placeholder="Search Recipes..." >
                     <button type="submit">Search</button>
                 </form>
            </div>
            <div class="user-menu">
                <!-- User menu goes here -->
                <!-- .... -->
                 <?php if (!empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true): ?>
                    <span class="user-greeting"> Greetings, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <?php else: ?>
                    <a href="#" data-open-modal="loginModal">Login</a>
                <?php endif; ?>
                 <img src="../images/guest_user_image.svg" alt="User Icon">
            </div>
            <div class="hamburger-menu">
                <!-- Hamburger menu goes here -->
            </div>

        
        </nav>
    </header>
</body>
</html>
