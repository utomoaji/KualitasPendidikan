</div>
</section>
</div>

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.4
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<!-- jQuery -->
<script src="<?= BASEURL ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= BASEURL ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php if (isset($data['js'])) { ?>
    <?php if ($data['js'] == 'datatable') { ?>
        <script src="<?= BASEURL ?>/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= BASEURL ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= BASEURL ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= BASEURL ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <?php } elseif ($data['js'] == 'chart') { ?>
        <script src="<?= BASEURL ?>/plugins/chart.js/Chart.min.js"></script>
    <?php } ?>
<?php } ?>
<!-- AdminLTE App -->
<script src="<?= BASEURL ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= BASEURL ?>/dist/js/demo.js"></script>

<?php if (isset($data['js'])) { ?>
    <?php if ($data['js'] == 'datatable') { ?>
        <script>
            $(document).ready(function() {
                $('#data').DataTable({
                    "responsive": true,
                    "autoWidth": false,
                });
            });
        </script>

    <?php } elseif ($data['js'] == 'chart') { ?>

    <?php } ?>
<?php } ?>

</body>

</html>