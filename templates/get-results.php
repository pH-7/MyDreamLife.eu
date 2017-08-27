<div class="center">
    <h2>My Results</h2>

    <form method="post" action="<?php echo site_url('confirmation') ?>">
        <input type="email" name="email" placeholder="Main Email Address" required>
        <input type="text" name="name" class="nofield"> <!-- Spambot prevention using a hidden field -->
        <button type="submit" class="waves-effect waves-light btn-large">
            <i class="material-icons right">send</i> Get My LIFE itinerary
        </button>
    </form>
</div>