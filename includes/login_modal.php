<?php
$loginError = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);

?>

<dialog id="loginModal" class="modal" <?= $loginError ? 'data-auto-open="true"' : '' ?>>

<?php if ($loginError): ?>
  <div class="error-banner">
    <?= htmlspecialchars($loginError) ?>
  </div>
<?php endif; ?>
    <div class="modal-content">

        <div class="modal-header">
            <h2>Login</h2>
            <button type="button" class="close-modal" onclick="document.getElementById('loginModal').close()">×</button>
        </div>

        <div class="modal-body">
            <?php if ($loginError): ?>
                <div class="error-banner">
                <?=  htmlspecialchars($loginError) ?>
                </div> 
            <?php endif; ?>

            <form action="/Recipe_Website/includes/Login_page/process_login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <div class="form-group"><!-- This input is so the login modal knows where to redirect after login -->
                        <input type="hidden" name="redirect_to" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                    </div> <!-- end hidden redirect_to form-group -->


                    <div class="button-group">
                        <button type="submit">Login</button>
                    </div>
            </form><!-- end login form -->
        </div><!-- end modal-body -->
    </div><!-- end modal-content -->
</dialog><!-- end loginModal -->