<?php foreach($posts as $post): ?>


    <div class="post_block_title">
        <h1>
            <a href="/post/?id=<?php echo $post->getId(); ?>">
                <?php echo $post->getTitle(); ?>
            </a>
        </h1>
    </div>

    <div class="post_block_user">
        <?php echo $post->getUser()->getLogin(); ?>
    </div>

    <div class="post_block_date">
        <?php echo $post->getDate(); ?>
    </div>


    <div class="post_block_text">
        <?php echo $post->getText(); ?>
    </div>


<?php endforeach; ?>
