<?php echo (isset($error)) ? $error : ''; ?>

<form action="/auth/" method="post">
    <fieldset>
        <legend>Authorization</legend>
        <div>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" value="admin">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="text" id="password" name="password" value="admin">
        </div>
        <div class="submit">
            <input type="submit" value="Submit">
        </div>
    </fieldset>
</form>
