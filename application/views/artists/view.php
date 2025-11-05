<div class="container">
    <h1><?php echo $title; ?></h1>
    <div class="list-group">
        <?php foreach ($posts as $post): ?>
            <a href="<?php echo base_url('posts/view/' . $post['slug']); ?>" class="list-group-item list-group-item-action">
                <?php echo $post['title']; ?>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="mt-4">
        <?php echo $links; ?>
    </div>
</div>
