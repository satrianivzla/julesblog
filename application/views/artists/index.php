<div class="container">
    <h1><?php echo $title; ?></h1>
    <div class="list-group">
        <?php foreach ($artists as $artist): ?>
            <a href="<?php echo base_url('artist/' . $artist->username); ?>" class="list-group-item list-group-item-action">
                <?php echo $artist->first_name . ' ' . $artist->last_name; ?>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="mt-4">
        <?php echo $links; ?>
    </div>
</div>
