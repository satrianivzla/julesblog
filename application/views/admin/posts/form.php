<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php echo form_open_multipart(isset($post) ? 'admin/posts/update/' . $post['id'] : 'admin/posts/store'); ?>
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
                                <label for="title_en">Title (English)</label>
                                <input type="text" name="title_en" id="title_en" class="form-control" value="<?php echo isset($post) ? $post['title_en'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="content_en">Content (English)</label>
                                <textarea name="content_en" id="content_en" class="form-control ckeditor"><?php echo isset($post) ? $post['content_en'] : ''; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="seo_title_en">SEO Title (English)</label>
                                <input type="text" name="seo_title_en" id="seo_title_en" class="form-control" value="<?php echo isset($post) ? $post['seo_title_en'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="seo_description_en">SEO Description (English)</label>
                                <textarea name="seo_description_en" id="seo_description_en" class="form-control"><?php echo isset($post) ? $post['seo_description_en'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="es" role="tabpanel" aria-labelledby="es-tab">
                            <div class="form-group">
                                <label for="title_es">Title (Spanish)</label>
                                <input type="text" name="title_es" id="title_es" class="form-control" value="<?php echo isset($post) ? $post['title_es'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="content_es">Content (Spanish)</label>
                                <textarea name="content_es" id="content_es" class="form-control ckeditor"><?php echo isset($post) ? $post['content_es'] : ''; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="seo_title_es">SEO Title (Spanish)</label>
                                <input type="text" name="seo_title_es" id="seo_title_es" class="form-control" value="<?php echo isset($post) ? $post['seo_title_es'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="seo_description_es">SEO Description (Spanish)</label>
                                <textarea name="seo_description_es" id="seo_description_es" class="form-control"><?php echo isset($post) ? $post['seo_description_es'] : ''; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="featured_image">Featured Image</label>
                        <input type="file" name="featured_image" id="featured_image" class="form-control">
                        <?php if (isset($post) && !empty($post['featured_image'])): ?>
                            <img src="<?php echo base_url('uploads/images/' . $post['featured_image']); ?>" alt="Featured Image" class="img-thumbnail mt-2" width="200">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="categories">Categories</label>
                        <select name="categories[]" id="categories" class="form-control" multiple>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>" <?php echo (isset($post_categories) && in_array($category['id'], $post_categories)) ? 'selected' : ''; ?>>
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags (comma-separated)</label>
                        <input type="text" name="tags" id="tags" class="form-control" value="<?php echo isset($post_tags) ? implode(', ', $post_tags) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="published" <?php echo (isset($post) && $post['status'] == 'published') ? 'selected' : ''; ?>>Published</option>
                            <option value="draft" <?php echo (isset($post) && $post['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Post</button>
                <?php echo form_close(); ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
