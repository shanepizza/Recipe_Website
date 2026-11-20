<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//This must include the session start code because we do not include header.php here


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // set session variables for logged in user
    $username = trim($_POST['username'] ?? '');

    if(!empty($username)) {

        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $username;

        //Take the user to the redirect URL after successful login
        $redirectUrl = $_POST['redirect_to'];
        if (!str_starts_with($redirectUrl, '/')) {
            $redirectUrl = '/Recipe_Website/index.php';
        }
        header("Location: " . $redirectUrl);
        exit;
    }
}



//This section hanldes bad login attempts or missing username
    
// Fallback to index.php if redirect_to is missing or invalid
$redirectUrl = $_POST['redirect_to'] ?? '/Recipe_Website/index.php';

// Basic security check to ensure redirect stays on your own site
if (!str_starts_with($redirectUrl, '/')) {
    $redirectUrl = '/Recipe_Website/index.php';
}

header("Location: " . $redirectUrl);
exit;
?>
<form action="/Recipe_Website/includes/Login_page/process_login.php" method="POST">
