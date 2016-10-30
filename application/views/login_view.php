<form class="login_form" action="login/enter" method="post">
        <span>
            <label>login:<br></label>
            <input name="login" type="text" size="15" maxlength="15">
        </span>
        <br>
        <span>
            <label>password:<br></label>
            <input name="password" type="password" size="15" maxlength="15">
        </span>
        <br>

        <button type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Вход</button>  
</form>
<p>
    <?
        echo $data;
    ?>
</p>