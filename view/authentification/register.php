<div class="form register-form column">
    <h1 class="outfit">Register</h1>

    <form class="column" method="post" action="index.php?ctrl=security&action=register">
        <!-- Change url of link in layout ? -->
        <div class="input-and-label column">
            <label class="sat20" for="mail">Mail</label>
            <input type="email" name="mail" id="mail" placeholder="Email" required>
        </div>

        <div class="input-and-label column">
            <label class="sat20" for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
        </div>

        <div class="input-and-label column">
            <label class="sat20" for="password1">Password</label>
            <input type="password" name="pass1" id="password1" placeholder="Password" required>
        </div>

        <div class="input-and-label column">
            <label class="sat20" for="password2">Confirm your password</label>
            <input type="password" name="pass2" id="password2" placeholder="Confirm your password" required>
        </div>

        <input class="big-btn outfit" type="submit" value="Create account" name="register">
    </form>

    <p>Already registered ? <a class="form-link" href="index.php?ctrl=security&action=loginPage">Login</a></p>
</div>