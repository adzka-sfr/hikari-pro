</div>
</div>
</div>
</div>
<!-- /page content -->



<!-- footer content -->
<footer>
    <div class="pull-right">
        ©2022 All Rights Reserved. Yamaha Indonesia . Privacy and Terms
    </div>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<!-- konflik dengan search in  -->
<script src="<?= base_url('_assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/fastclick/lib/fastclick.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/nprogress/nprogress.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/Chart.js/dist/Chart.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/gauge.js/dist/gauge.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/iCheck/icheck.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/skycons/skycons.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/Flot/jquery.flot.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/Flot/jquery.flot.pie.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/Flot/jquery.flot.time.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/Flot/jquery.flot.stack.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/Flot/jquery.flot.resize.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/flot-spline/js/jquery.flot.spline.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/flot.curvedlines/curvedLines.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/DateJS/build/date.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/jqvmap/dist/jquery.vmap.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/moment/min/moment.min.js') ?>"></script>
<script src="<?= base_url('_assets/vendors/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<script src="<?= base_url('_assets/build/js/custom.min.js') ?>"></script>
</body>

</html>

<script>
    $(document).ready(function() {
        load_data();

        function load_data(query = "") {
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {
                    query: query,
                },
                success: function(data) {
                    $("#body").html(data);
                },
            });
        }
        $("#multi_search_filter").change(function() {
            $("#hidden_date").val($("#multi_search_filter").val());
            var query = $("#hidden_date").val();
            load_data(query);
        });

        $("#multi_search_filter").change(function() {
            $("#hidden_date").val($("#multi_search_filter").val());
            var query = $("#hidden_date").val();
            load_data(query);
        });
    });
</script>