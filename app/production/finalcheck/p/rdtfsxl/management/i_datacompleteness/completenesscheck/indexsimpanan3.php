<?php require '../../../config.php'; ?>
<div class="row">
    <div class="col-12">
        <?php
        $model = array();
        $q4 = mysqli_query($connect_pro, "SELECT c_code_model FROM finalcheck_list_specific_model WHERE c_code_model LIKE 's-%' ORDER BY c_code_model ASC");
        while ($d4 = mysqli_fetch_array($q4)) {
            array_push($model, $d4['c_code_model']);
        }
        ?>
        <table class="table table-bordered dothemagictotable">
            <thead>
                <th style="width: 50px; text-align: center; background-color: #464646; color: white; z-index: 3;">No</th>
                <th style="width: 150px;background-color: #464646; color: white; z-index: 3;">Process Name</th>
                <?php
                foreach ($model as $key) {
                ?>
                    <th style="width: 75px; text-align: center;"><?= $key ?></th>
                <?php
                }
                ?>
            </thead>
            <tbody>
                <?php
                $no = 0;
                // name ng
                $q3 = mysqli_query($connect_pro, "SELECT c_detail, c_code_completeness FROM finalcheck_list_completeness");
                while ($d3 = mysqli_fetch_array($q3)) {
                    $no++;
                    $code_completeness = $d3['c_code_completeness'];


                ?>
                    <tr>
                        <td style="text-align: center; background-color: #464646; color: white; z-index: 3;"><?= $no ?></td>
                        <td style="background-color: #464646; color: white;z-index: 3;"><?= $d3['c_detail'] ?></td>
                        <?php
                        foreach ($model as $key) {
                            // cek disable/enable
                            $q5 = mysqli_query($connect_pro, "SELECT c_status FROM finalcheck_list_completeness_model WHERE c_code_model = '$key' AND c_code_completeness = '$code_completeness'");
                            $d5 = mysqli_fetch_array($q5);

                            // check enable/disable
                            if ($d5['c_status'] == 'enable') {
                                $cheklis_default = 'checked';
                            } else {
                                $cheklis_default = '';
                            }
                            $key2 = str_replace(' ', '', $key);
                        ?>
                            <th style="text-align: center;"><input disabled <?= $cheklis_default ?> id="inside<?= $code_completeness . $key2 ?>" onchange="cekbok1(this.id,'<?= $key ?>', '<?= $code_completeness ?>')" value="<?= $code_completeness ?>" type="checkbox" style="transform: scale(2);"></th>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
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

                function cekbok1(id, model, code) {
                    if ($('#' + id).is(':checked')) {
                        console.log($('#' + id).val() + ': cuscab - centang');
                        result = 'enable';
                    } else {
                        console.log($('#' + id).val() + ': cuscab - tidak centang');
                        result = 'disable';
                    }
                    var code_model = model;
                    var code_completeness = code;

                    $.ajax({
                        url: "management/i_datacompleteness/completenesscheck/datachange.php",
                        type: "POST",
                        data: {
                            "code_model": code_model,
                            "code_completeness": code_completeness,
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
        <script>
            $('.dothemagictotable').DataTable({
                scrollY: '500px',
                // scrollCollapse: true,
                paging: false,
                scrollCollapse: true,
                scrollX: true,
                fixedColumns: {
                    left: 2,
                    top: 1,
                },
                "dom": '<"wrapper"flipt>'
            });
        </script>
    </div>
</div>