<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if (is_string($username) && filter_var($username, FILTER_VALIDATE_EMAIL)
        && is_string($password) && $password !== '') {
        $_SESSION['account_message'] = "Account creation is not implemented yet. Submitted email: $username.";
    } else {
        $_SESSION['account_message'] = 'Please enter a valid email address and password.';
    }
}
?>
<!DOCTYPE html>
<!-- This login page will eventually transition to a login view that pops up over the main content -->





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css%20files/login-register-pages.css">
    <script src="../scripts/login_script.js"></script>

    <title>Recipe Website - Create Account</title>
</head>
<body>
    <div class="content-wrapper main-content">
        <div class="login-form">
            <form action="Create_Account.php" method="post">
                <div class="form-group header">
                    <h2>Create Account</h2>
                </div>

                <?php if (isset($_SESSION['account_message'])): ?>
                    <p role="status"><?= htmlspecialchars($_SESSION['account_message'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                    <?php unset($_SESSION['account_message']); ?>
                <?php endif; ?>

                <div class="form-group continue-with-social">
                    <p>Or continue with social media:</p>
                </div>      
                
                <div class="form-group divider">
                    <!-- This is the seperator between continue-with-social and the main login form -->
                    <span>or</span>
                </div>

                <div class="form-group" id="name-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Name" required>
                </div>

                <div class="form-group">
                    <label for="username">Email:</label>
                    <input type="email" id="username" name="username" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
               

                


                <div class="form-group">
                    <div class="login-button">
                        <button type="submit" >Create Account</button>
                        <!-- This is for filling the email and password field automatically for testing purposes. -->
                        <button type="button" onClick="fillTestCredentialsCorrect()">FTC</button>
                        <button type="button" onClick="fillTestCredentialsIncorrect()">FTI</button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>


    
</body>
</html>