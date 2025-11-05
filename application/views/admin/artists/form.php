<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php echo form_open_multipart(isset($artist) ? 'admin/artists/update/' . $artist['id'] : 'admin/artists/store'); ?>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($artist) ? $artist['name'] : ''; ?>" required>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="true">English</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="es-tab" data-toggle="tab" href="#es" role="tab" aria-controls="es" aria-selected="false">Spanish</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="en" role="tabpanel" aria-labelledby="en-tab">
                            <div class="form-group">
                                <label for="bio_en">Biography (English)</label>
                                <textarea name="bio_en" id="bio_en" class="form-control ckeditor"><?php echo isset($artist) ? $artist['bio_en'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="es" role="tabpanel" aria-labelledby="es-tab">
                            <div class="form-group">
                                <label for="bio_es">Biography (Spanish)</label>
                                <textarea name="bio_es" id="bio_es" class="form-control ckeditor"><?php echo isset($artist) ? $artist['bio_es'] : ''; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Artist Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <?php if (isset($artist) && !empty($artist['image'])): ?>
                            <img src="<?php echo base_url('uploads/artists/images/' . $artist['image']); ?>" alt="Artist Image" class="img-thumbnail mt-2" width="200">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="social_media_links">Social Media Links (comma-separated)</label>
                        <input type="text" name="social_media_links" id="social_media_links" class="form-control" value="<?php echo isset($artist) ? $artist['social_media_links'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="official_website">Official Website</label>
                        <input type="url" name="official_website" id="official_website" class="form-control" value="<?php echo isset($artist) ? $artist['official_website'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="online_store">Online Store</label>
                        <input type="url" name="online_store" id="online_store" class="form-control" value="<?php echo isset($artist) ? $artist['online_store'] : ''; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Artist</button>
                <?php echo form_close(); ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
