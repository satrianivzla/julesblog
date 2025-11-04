<div class="container">
    <h1><?php echo $title; ?></h1>
    <div class="list-group">
        <?php foreach ($categories as $category): ?>
            <a href="<?php echo base_url('category/' . $category['slug']); ?>" class="list-group-item list-group-item-action">
                <?php echo $category['name']; ?>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="mt-4">
        <?php echo $links; ?>
    </div>
</div>
