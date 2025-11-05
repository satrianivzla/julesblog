<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="<?php echo base_url('uploads/artists/images/' . $artist['image']); ?>" alt="<?php echo $artist['name']; ?>" class="img-fluid rounded-circle">
        </div>
        <div class="col-md-8">
            <h1><?php echo $artist['name']; ?></h1>
            <p class="lead"><?php echo $this->lang->line('biography'); ?></p>
            <div>
                <?php echo $this->session->userdata('site_lang') == 'spanish' ? $artist['bio_es'] : $artist['bio_en']; ?>
            </div>
            <hr>
            <p><strong><?php echo $this->lang->line('social_media'); ?>:</strong> <?php echo $artist['social_media_links']; ?></p>
            <p><strong><?php echo $this->lang->line('official_website'); ?>:</strong> <a href="<?php echo $artist['official_website']; ?>" target="_blank"><?php echo $artist['official_website']; ?></a></p>
            <p><strong><?php echo $this->lang->line('online_store'); ?>:</strong> <a href="<?php echo $artist['online_store']; ?>" target="_blank"><?php echo $artist['online_store']; ?></a></p>
        </div>
    </div>

    <hr>

    <h2><?php echo $this->lang->line('related_posts'); ?></h2>

    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="<?php echo base_url('uploads/images/' . $post['featured_image']); ?>" class="card-img-top" alt="<?php echo $post['title_en']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $this->session->userdata('site_lang') == 'spanish' ? $post['title_es'] : $post['title_en']; ?></h5>
                        <p class="card-text"><?php echo word_limiter($this->session->userdata('site_lang') == 'spanish' ? $post['content_es'] : $post['content_en'], 20); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="<?php echo site_url('posts/view/' . $post['slug']); ?>" class="btn btn-sm btn-outline-secondary"><?php echo $this->lang->line('view_details'); ?></a>
                            </div>
                            <small class="text-muted"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row">
        <div class="col-12">
            <?php echo $links; ?>
        </div>
    </div>
</div>
