<!-- footer content -->
<!-- z-index untuk mengatur susunan tumpang tindih -->
<footer style="background-color: #EDEDED; z-index: 0;">
    <div class="pull-right">
        <!-- Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a> -->
        ©2022 All Rights Reserved. Yamaha Indonesia . <a href="#">Privacy and Terms</a>

    </div>
    <div class="clearfix"></div>
</footer>

<!-- SRIPT TAMBAHAN -->

<!-- untuk fulscreen -->
<!-- <script>
    var goFS = document.getElementById("goFS");
    goFS.addEventListener("click", function() {
        document.body.requestFullscreen();
    }, false);
</script> -->

<!-- untuk dropdown search -->
<script>
    $('.cari_slip').select2({
        placeholder: "Slip Number",
    });
    $('.cari_user').select2();
    $('#cari').select2();
    $('#kon').select2();
</script>

<!-- untuk datatables -->
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();

    });

    $(document).ready(function() {
        $('#kontol').DataTable({
            scrollY: '300px',
            scrollCollapse: true,
            paging: false,
        });
    });
</script>

<!-- untuk disable tanggal kemarin -->
<!-- <script type="text/javascript">
    var date = new Date();
    var day = date.getDate()
    var month = date.getMonth() + 1
    var year = date.getFullYear()
    if (day < 10) {
        day = '0' + day
    }
    if (month < 10) {
        month = '0' + month
    }


    var minDate = year + '-' + month + '-' + day
    document.getElementById('tanggal_kemarin').setAttribute("min", minDate);
</script> -->
<!-- untuk disable tanggal kemarin -->

<!-- SRIPT TAMBAHAN -->

<!-- jQuery -->
<script src="<?= base_url('_assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?= base_url('_assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?= base_url('_assets/vendors/fastclick/lib/fastclick.js') ?>"></script>

<!-- NProgress -->
<script src="<?= base_url('_assets/vendors/nprogress/nprogress.js') ?>"></script>
<!-- Chart.js -->
<script src="<?= base_url('_assets/vendors/Chart.js/dist/Chart.min.js') ?>"></script>
<!-- gauge.js -->
<script src="<?= base_url('_assets/vendors/gauge.js/dist/gauge.min.js') ?>"></script>
<!-- bootstrap-progressbar -->
<script src="<?= base_url('_assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?= base_url('_assets/vendors/iCheck/icheck.min.js') ?>"></script>
<!-- Skycons -->
<script src="<?= base_url('_assets/vendors/skycons/skycons.js') ?>"></script>
<!-- Flot -->
<script src="<?= base_url('_assets/vendors/Flot/jquery.flot.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/Flot/jquery.flot.pie.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/Flot/jquery.flot.time.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/Flot/jquery.flot.stack.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/Flot/jquery.flot.resize.js') ?>"></script>
<!-- Flot plugins -->
<script src="<?= base_url('_assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/flot-spline/js/jquery.flot.spline.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/flot.curvedlines/curvedLines.js') ?>"></script>
<!-- DateJS -->
<script src="<?= base_url('_assets/vendors/DateJS/build/date.js') ?>"></script>
<!-- JQVMap -->
<script src="<?= base_url('_assets/vendors/jqvmap/dist/jquery.vmap.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?= base_url('_assets/vendors/moment/min/moment.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>

<!-- Datatables -->
<script src="<?= base_url('_assets/vendors/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/jszip/dist/jszip.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/pdfmake/build/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/pdfmake/build/vfs_fonts.js') ?>"></script>

<!-- jQuery custom content scroller -->
<script src="<?= base_url('_assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') ?>"></script>

<!-- Custom Theme Scripts -->
<script src="<?= base_url('_assets/build/js/custom.min.js') ?>"></script>

<!-- Tambahan -->

</body>

</html>