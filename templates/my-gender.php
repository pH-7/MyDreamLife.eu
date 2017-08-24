<div class="center">
    <h2>My Gender</h2>

    <form method="post" action="<?php echo site_url('my-age') ?>">
        <input type="image" name="gender" class="gender icon"
               src="<?php echo asset_url('img/icons/gender/male.svg') ?>" value="male" alt="Man">
        <input type="image" name="gender" class="gender icon"
               src="<?php echo asset_url('img/icons/gender/female.svg') ?>" value="female" alt="Woman">
    </form>
</div>
