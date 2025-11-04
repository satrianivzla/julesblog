<div class="container">
    <h1><?php echo $title; ?></h1>

    <h2>Posts</h2>
    <?php if (!empty($posts)): ?>
        <ul class="list-group">
            <?php foreach ($posts as $post): ?>
                <li class="list-group-item"><a href="<?php echo site_url('posts/view/' . $post['slug']); ?>"><?php echo $post['title']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>

    <h2 class="mt-4">Categories</h2>
    <?php if (!empty($categories)): ?>
        <ul class="list-group">
            <?php foreach ($categories as $category): ?>
                <li class="list-group-item"><a href="<?php echo site_url('category/' . $category['slug']); ?>"><?php echo $category['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No categories found.</p>
    <?php endif; ?>

    <h2 class="mt-4">Tags</h2>
    <?php if (!empty($tags)): ?>
        <ul class="list-group">
            <?php foreach ($tags as $tag): ?>
                <li class="list-group-item"><a href="<?php echo site_url('tag/' . $tag['slug']); ?>"><?php echo $tag['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tags found.</p>
    <?php endif; ?>

    <h2 class="mt-4">Artists</h2>
    <?php if (!empty($artists)): ?>
        <ul class="list-group">
            <?php foreach ($artists as $artist): ?>
                <li class="list-group-item"><a href="<?php echo site_url('artist/' . $artist->username); ?>"><?php echo $artist->first_name . ' ' . $artist->last_name; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No artists found.</p>
    <?php endif; ?>
</div>
