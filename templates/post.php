
<div class="post_block_title">
    <h1>
        <?php echo $post->getTitle(); ?>
    </h1>
</div>

<div class="post_block_user">
    <?php echo $post->getUser()->getLogin(); ?>
</div>

<div class="post_block_date">
    <?php echo $post->getDate(); ?>
</div>


<div class="post_block_text">
    <?php echo nl2br($post->getText()); ?>
</div>


<form action="/newcomment/" method="post">
    <input type="hidden" name="form[id_post]" value="<?php echo $post->getId(); ?>">
    <fieldset>
        <legend>New comment</legend>

        <div>
            <label for="comment">Comment:</label>
            <textarea id="comment" name="form[comment]"></textarea>
        </div>
        <div class="submit">
            <input type="submit" value="Submit">
        </div>
    </fieldset>
</form>

<?php foreach ($post->getComments() as $comment): ?>

    <hr>
    <div class="post_block_user">
        <?php if ($comment->getUser()): ?>
            <?php echo $comment->getUser()->getLogin(); ?>
        <?php else: ?>
            noname
        <?php endif; ?>
    </div>
    <div class="post_block_date">
        <?php echo $comment->getDate(); ?>
    </div>
    <div class="post_block_text">
        <?php echo $comment->getComment(); ?>
    </div>

<?php endforeach; ?>
