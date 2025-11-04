</main>
    </div>
</div>

<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-rc4/dist/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-rc4/dist/js/adminlte.min.js"></script>

<!-- CKEditor JS -->
<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>

<!-- Custom script to initialize plugins -->
<script>
$(document).ready(function() {
    // Initialize DataTables on any table with the class 'datatable'
    $('.datatable').DataTable();

    // Initialize CKEditor on any textarea with the class 'ckeditor'
    if (document.querySelector('.ckeditor')) {
        CKEDITOR.replace('content');
    }
});
</script>

</body>
</html>
