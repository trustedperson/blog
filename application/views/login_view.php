<script src='https://www.google.com/recaptcha/api.js'></script>
<form class="login_form" action="login/enter" method="post">
        <span>
            <label>Email:<br></label>
            <input name="email" type="text" size="30" maxlength="30">
        </span>
        <br>
        <span>
            <label>Password:<br></label>
            <input name="password" type="password" size="30" maxlength="30">
        </span>
        <br>
        <div class="g-recaptcha" data-sitekey="6LfOswoUAAAAAGntCXb1kY6lc6H0LOLQfOpbdyWl">
        </div>
        <br>
        <button type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Вход</button>  
</form>
<p>
    <?
        echo $data;
    ?>
</p>