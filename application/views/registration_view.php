<script src='https://www.google.com/recaptcha/api.js'></script>
<form class="reg_form" action="registration/enter" method="post">
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
        <span>
            <label>First name:<br></label>
            <input name="first_name" type="text" size="50" maxlength="50">
        </span>
        <br>
        <span>
            <label>Last name:<br></label>
            <input name="last_name" type="text" size="50" maxlength="50">
        </span>
        <br>
        <div class="g-recaptcha" data-sitekey="6LfOswoUAAAAAGntCXb1kY6lc6H0LOLQfOpbdyWl"></div>
        <span>
            <button type="submit"><i class="fa fa-male" aria-hidden="true"></i> Зарегистрироваться!</button>
        </span>

    </form>
    <p>
    	<?
    	echo $data;
    	?>
    </p>