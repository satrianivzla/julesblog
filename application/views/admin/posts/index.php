<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?></h3>
                <div class="card-tools">
                    <a href="<?php echo site_url('admin/posts/create'); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Post
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="posts-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td><?php echo html_escape($post['title']); ?></td>
                                <td><?php echo $post['status']; ?></td>
                                <td><?php echo $post['created_at']; ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/posts/edit/' . $post['id']); ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?php echo site_url('admin/posts/delete/' . $post['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
