<?php echo (isset($error)) ? $error : ''; ?>

<form action="/newpost/" method="post">
    <?php if ($session->isClientAuthorized()): ?>
    <fieldset>
        <legend>New post</legend>
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="form[title]" value="">
        </div>
        <div>
            <label for="text">Post:</label>
            <textarea id="text" name="form[text]"></textarea>
        </div>
        <div class="submit">
            <input type="submit" value="Submit">
        </div>
    </fieldset>

    <?php else: ?>
        You need <a href="/authform/">authorize</a> first
    <?php endif; ?>
</form>
