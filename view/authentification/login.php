<?php
    $mail = $result["data"]['mail'] ?? NULL;
?>
<div class="form login-form column">
    <h1 class="outfit">Login</h1>

    <form class="column" method="post" action="index.php?ctrl=security&action=login">
        <!-- Change url of link in layout ? -->
        <div class="input-and-label column">
            <label for="mail" class="sat20">Mail</label>
            <input type="email" name="mail" id="mail" placeholder="Email" 
            <?php if($mail) {?> 
                value="<?= $mail ?>"
            <?php }?>
            required>
        </div>

        <div class="input-and-label column">
            <label for="password" class="sat20">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <a class="form-link form-link__mini" href="#">Forgot your password ?</a>
        </div>

        <input type="submit" value="Login" name="login" class="big-btn outfit">
    </form>

    <p>No account yet ? <a class="form-link" href="index.php?ctrl=security&action=registerPage">Register</a></p>
</div>