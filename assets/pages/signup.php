<!-- <?php
        // print_r($_SESSION['error']);
        ?> -->
<div class="signup-container">
    <div id="img-div">
        <img src="assets/images/MY BOOK.png" alt="logo successfully" id="logo_img">
        <h2>Create new account</h2>

    </div>
    <form action="assets/php/action.php?signup" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" value="<?= showFormData('username') ?>">
        </div>
        <?= showError('username') ?>

        <div class="Gender_div">
            <label for="gender">Gender</label>
            <input type="radio" id="male" name="gender" value="1"
                <?=isset($_SESSION['formdata'])?'':'checked'?>

                <?= showFormData('gender') == 1 ? 'checked' :''?>>
              <label for="male" class="radio-label">MALE</label>
            
              <input type="radio" id="female" name="gender" value="2"
                <?= showFormData('gender') == 2 ? 'checked' :'' ?>>
              <label for="female" class="radio-label">FEMALE</label>
            
              <input type="radio" id="other" name="gender" value="0"
                <?= showFormData('gender') == 0 ? 'checked' :''?>>
              <label for="other" class="radio-label">OTHERS</label>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= showFormData('email') ?>">
        </div>

        <?= showError('email') ?>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" value="<?= showFormData('password') ?>">
        </div>
        <?= showError('password') ?>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" value="<?= showFormData('confirm_password') ?>">
        </div>
        <?= showError('confirm_password') ?>

        <button type="submit" class="btn" name="Signup">Sign Up</button>
    </form>
    <div class="login-link">
       <a href="?login">  Already have an account?</a>
       <!-- <a href="?login">Log in</a> -->
    </div>
</div>