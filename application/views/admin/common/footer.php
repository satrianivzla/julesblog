      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">JulesBlog</a>.</strong>
    All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 5 JS Bundle -->
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/adminlte/adminlte.min.js'); ?>"></script>
<!-- DataTables JS -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<!-- CKEditor JS -->
<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>

<script>
$(document).ready(function() {
    $('.datatable').DataTable();
    if (document.querySelector('.ckeditor')) {
        CKEDITOR.replace('content');
    }
});
</script>

</body>
</html>
