<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url('admin/dashboard'); ?>" class="brand-link">
        <span class="brand-text font-weight-light">JulesBlog Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><?php $user = $this->ion_auth->user()->row(); echo html_escape($user->username); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/posts'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Posts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/categories'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/tags'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Tags</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/artists'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Artists</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('auth'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
