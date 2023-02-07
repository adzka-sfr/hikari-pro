<script src="<?= base_url('_assets/src/add/dropdown_search/jquery-3.4.1.js') ?>" crossorigin="anonymous"></script>
<script src="../jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#refres1").on('change', function() {
            var isia = $('#refres1').val();
            $.ajax({
                url: "dashboard/tabel_log.php",
                method: "POST",
                data: {
                    isia: isia
                },
                success: function(data) {
                    $('#Container1').html(data);
                }
            });
        });
    });
</script>
<div class="row">
    <div class="col-12">
        <h5>Dashboard</h5>
        <div class="separator"></div>
        <div class="row">
            <div class="col-7 mb-2">
                <input class="date-picker form-control" type="date" id="refres1">
            </div>
        </div>
        <div class="row">
            <div class="col-7 mb-3 tableFixHead-3">
                <!-- <select id="refres1" name="wc1">
                    <option value="" selected disabled>Select Work Center</option>
                    <option value="2023-02-01">1</option>
                    <option value="2023-02-02">2</option>
                    <option value="2023-02-03">3</option>
                </select> -->
                <div id="Container1">
                    <?php include "dashboard/tabel_log.php" ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="main" style="width: 100%; height:300px;"></div>
                <?php
                include 'grafik.php';
                ?>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div id="main2" style="width: 100%; height:300px;"></div>
                <?php
                include 'grafik-year.php';
                ?>

            </div>
        </div>
    </div>
</div>