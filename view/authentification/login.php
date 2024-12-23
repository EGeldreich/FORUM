<?php
    $mail = $result["data"]['mail'] ?? NULL;
?>
<div class="form login-form column">
    <h1>Login</h1>

    <form class="" method="post" action="index.php?ctrl=security&action=login">
        <!-- Change url of link in layout ? -->
        <div class="input-and-label column">
            <label for="mail">Mail</label>
            <input type="email" name="mail" id="mail" placeholder="Email" 
            <?php if($mail) {?> 
                value="<?= $mail ?>"
            <?php }?>
            required>
        </div>

        <div class="input-and-label column">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <a class="form-link__mini" href="#">Forgot your password</a>
        </div>

        <input type="submit" value="Create account" value="register">
    </form>

    <p>Already registered ? <a class="form-link" href="index.php?ctrl=security&action=loginPage">Login</a></p>
</div>