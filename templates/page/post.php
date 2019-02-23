<section class="center bottom-margin">
    <h2><?php echo $title ?></h2>
    <article>
        <?php if (isset($vimeoId)):
            include 'vimeo-embed.inc.php';
        elseif (isset($imageUrl)):
            include 'image.inc.php';
        endif; ?>

        <p><?php echo $description ?></p>
        <p>
            See also the <a href="<?php echo site_url('apps') ?>" rel="nofollow noopener" target="_blank" class="underline">useful apps</a> to get before your trip.
        </p>

        <div class="post-button">
            <a href="<?php echo site_url() ?>" class="waves-effect orange-light btn-large">
                Get Your OWN Itinerary
            </a>
        </div>
    </article>
</section>
