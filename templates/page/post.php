<section class="center bottom-margin">
    <h3><?php echo $title ?></h3>
    <article>
        <iframe src="https://player.vimeo.com/video/<?php echo $vimeoId ?>" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        <p><?php echo $description ?></p>
        <p>See also the <a href="<?php echo site_url('apps') ?>" rel="nofollow noopener" target="_blank" class="underline">useful apps</a> to get before your trip.'</p>

        <div class="">
            <a href="<?php echo site_url() ?>" class="waves-effect orange-light btn-large">Get Your Itinerary</a>
        </div>
    </article>
</section>