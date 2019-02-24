<section class="center">
    <?php for ($postIndex = 1, $totalPosts = count($posts); $postIndex <= $totalPosts; $postIndex++): ?>
        <article>
            <h3>
                <a href="<?php echo site_url("p/{$posts[$postIndex]['uri']}/$postIndex") ?>">
                    <?php echo $posts[$postIndex]['title'] ?></a>
            </h3>

            <p>
                <?php echo mb_strimwidth(strip_tags($posts[$postIndex]['description']), 0, 150, '...') ?>
            </p>
            <p>
                <a href="<?php echo site_url("p/{$posts[$postIndex]['uri']}/$postIndex") ?>">
                    See The Post &rarr;
                </a>
            </p>

            <?php if ($postIndex < $totalPosts): ?>
                <hr>
            <?php endif ?>
        </article>
    <?php endfor ?>
</section>
