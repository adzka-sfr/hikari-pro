<?php require '../../../config.php'; ?>
<div class="row">
    <div class="col-12">
        <table class="table">
            <thead>
                <th style="width: 5%; text-align: center;">No</th>
                <th>Process/NG</th>
                <th style="text-align: center; width: 20%;">Enable/Disable</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $q1 = mysqli_query($connect_pro, "SELECT c_code_incheck, c_detail FROM finalcheck_list_incheck ORDER BY c_seq ASC");
                while ($d1 = mysqli_fetch_array($q1)) {
                    $no++;
                    // hitung ada berapa ng
                    $q2 = mysqli_query($connect_pro, "SELECT COUNT(c_code_ng) as total FROM finalcheck_list_ng WHERE c_group = '$d1[c_code_incheck]'");
                    $d2 = mysqli_fetch_array($q2);
                    $row = $d2['total'];
                ?>
                    <tr>
                        <td style="text-align: center;" rowspan="<?= $row + 1; ?>"><?= $no ?></td>
                        <td style="font-weight: bold;" colspan="2"><?= $d1['c_detail'] ?></td>
                    </tr>
                    <?php
                    // get NG
                    $q3 = mysqli_query($connect_pro, "SELECT c_name, c_code_ng, c_status FROM finalcheck_list_ng WHERE c_group = '$d1[c_code_incheck]'");
                    while ($d3 = mysqli_fetch_array($q3)) {
                        // get enable/disable
                        if ($d3['c_status'] == 'enable') {
                            $cheklis_default = 'checked';
                        } else {
                            $cheklis_default = '';
                        }
                    ?>
                        <tr>
                            <td><?= $d3['c_name'] ?></td>
                            <td style="text-align: center;"><input disabled <?= $cheklis_default ?> id="inside<?= $d3['c_code_ng'] ?>" onchange="cekbok1(this.id)" value="<?= $d3['c_code_ng'] ?>" type="checkbox" style="transform: scale(2);"></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
            <script>
                $('#lock').click(function() {
                    $('#lock').hide();
                    $('#unlock').show();
                    $('input[type=checkbox]').attr('disabled', false);
                })

                $('#unlock').click(function() {
                    $('#unlock').hide();
                    $('#lock').show();
                    $('input[type=checkbox]').attr('disabled', true);
                })

                function cekbok1(id) {
                    if ($('#' + id).is(':checked')) {
                        console.log($('#' + id).val() + ': cusng - centang');
                        result = 'enable';
                    } else {
                        console.log($('#' + id).val() + ': cusng - tidak centang');
                        result = 'disable';
                    }
                    var code_ng = $('#' + id).val();

                    $.ajax({
                        url: "management/f_datang/inside/datachange.php",
                        type: "POST",
                        data: {
                            "code_ng": code_ng,
                            "result": result
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            console.log(data.status);
                        },
                        error: function() {
                            lostconnection()
                        }
                    });
                }
            </script>
        </table>
    </div>
</div>