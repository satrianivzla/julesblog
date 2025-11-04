<div class="container">
    <h1><?php echo $title; ?></h1>
    <div class="list-group">
        <?php foreach ($tags as $tag): ?>
            <a href="<?php echo base_url('tag/' . $tag['slug']); ?>" class="list-group-item list-group-item-action">
                <?php echo $tag['name']; ?>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="mt-4">
        <?php echo $links; ?>
    </div>
</div>
