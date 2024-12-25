<div class="signup-container " id="login page">
    <div id="img-div">
        <img src="assets/images/MY BOOK.png" alt="logo successfully" id="logo_img">
        <h2>Please Sign In / Login</h2>

    </div>
    <form action="assets/php/action.php?login" method="POST">
        <div class="form-group">
            <label for="username_email">Username/Email</label>
            <input type="text" id="username_email" name="username_email" placeholder="Enter your email" value="<?= showFormData('username_email') ?>">
        </div>

        <?= showError('username_email') ?>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" value="<?= showFormData('password') ?>">
        </div>
        <?= showError('password') ?>
        <!--password email check with database-->
        <?= showError('checkuser') ?>

        <button type="submit" class="btn" name="Signin">Sign In</button>
        <div class="login-link">
        <a href="?forgotpassword">Forgot Password ?</a>
        </div>
    </form>

    <div class="login-link">
        <a href="?signup">Create New Account </a>
    </div>
</div>