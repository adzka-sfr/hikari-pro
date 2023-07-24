<?php
// get connection
require '../config.php';

$serialnumber = $_POST['serialnumber'];
$code_type = $_POST['codetype'];;
if ($code_type == 'f') {
    $format = 'png';
} elseif ($code_type == 'p') {
    $format = 'jpg';
}
?>
<!-- tbo image -->
<div class="row">
    <div class="col-12">
        <div class="containere">
            <img src="../art/<?= $code_type ?>/tbo.<?= $format ?>" style="width:100%; opacity: 60%;">
            <?php
            $c_code_type = $code_type;
            $c_image = "tbo";
            $qtbo = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_fetch_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND b.c_code_type = '$c_code_type' AND b.c_image = '$c_image'");
            while ($dtbo = mysqli_fetch_array($qtbo)) {
                $label_get = array();
                $label = array();
                $process_get = array();
                $process = array();
                $qtbolab = mysqli_query($connect_pro, "SELECT c_number_ng, c_process FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$dtbo[c_code_coordinate]'");

                while ($dtbolab = mysqli_fetch_array($qtbolab)) {
                    array_push($label_get, $dtbolab['c_number_ng']);
                    array_push($process_get, $dtbolab['c_process']);
                }
                $cnt = count($label_get);
                foreach ($label_get as $key => $val) {
                    if (($key + 1) == $cnt) {
                        array_push($label, $val);
                    } else {
                        array_push($label, $val . ', ');
                    }

                    if (($key + 1) % 2 == 0) {
                        array_push($label, '<br>');
                    }
                }

                $cnt2 = count($process_get);
                foreach ($process_get as $key2 => $val2) {
                    if (($key2 + 1) == $cnt2) {
                        array_push($process, $val2);
                    } else {
                        array_push($process, $val2 . ', ');
                    }

                    if (($key2 + 1) % 2 == 0) {
                        array_push($process, '<br>');
                    }
                }

            ?>
                <button class="btn ingpo" style="width: 25px; border-color: #000000; height: 25px; top: <?= $dtbo['c_top'] ?>%; left: <?= $dtbo['c_left'] ?>%;">
                    <?php
                    $row = count($label);
                    for ($s = 0; $s < $row; $s++) {
                        if ($process[$s] == 'oc1') {
                            $color_cab = '#DC4646';
                        } elseif ($process[$s] == 'oc2') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc3') {
                            $color_cab = '#1340FF';
                        } elseif ($process[$s] == 'oc1, ') {
                            $color_cab  = '#DC4646';
                        } elseif ($process[$s] == 'oc1<br>') {
                            $color_cab  = '#DC4646';
                        } elseif ($process[$s] == 'oc2, ') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc2<br>') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc3, ') {
                            $color_cab  = '#1340FF';
                        } elseif ($process[$s] == 'oc3<br>') {
                            $color_cab  = '#1340FF';
                        } else {
                            $color_cab = '#000';
                        }
                    ?>
                        <span style="padding: 0px; color: <?= $color_cab ?>;"><?= $label[$s] ?></span>
                    <?php
                    }
                    ?>
                </button>
            <?php
            }
            ?>

        </div>
    </div>
</div>
<!-- tbo image -->
<br>
<hr>
<br>
<!-- tbi image -->
<div class="row">
    <div class="col-12">
        <div class="containere">
            <img src="../art/<?= $code_type ?>/tbi.<?= $format ?>" style="width:100%; opacity: 60%;">
            <?php
            $c_code_type = $code_type;
            $c_image = "tbi";
            $qtbo = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_fetch_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND b.c_code_type = '$c_code_type' AND b.c_image = '$c_image'");
            while ($dtbo = mysqli_fetch_array($qtbo)) {
                $label_get = array();
                $label = array();
                $process_get = array();
                $process = array();
                $qtbolab = mysqli_query($connect_pro, "SELECT c_number_ng, c_process FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$dtbo[c_code_coordinate]'");

                while ($dtbolab = mysqli_fetch_array($qtbolab)) {
                    array_push($label_get, $dtbolab['c_number_ng']);
                    array_push($process_get, $dtbolab['c_process']);
                }
                $cnt = count($label_get);
                foreach ($label_get as $key => $val) {
                    if (($key + 1) == $cnt) {
                        array_push($label, $val);
                    } else {
                        array_push($label, $val . ', ');
                    }

                    if (($key + 1) % 2 == 0) {
                        array_push($label, '<br>');
                    }
                }

                $cnt2 = count($process_get);
                foreach ($process_get as $key2 => $val2) {
                    if (($key2 + 1) == $cnt2) {
                        array_push($process, $val2);
                    } else {
                        array_push($process, $val2 . ', ');
                    }

                    if (($key2 + 1) % 2 == 0) {
                        array_push($process, '<br>');
                    }
                }

            ?>
                <button class="btn ingpo" style="width: 25px; border-color: #000000; height: 25px; top: <?= $dtbo['c_top'] ?>%; left: <?= $dtbo['c_left'] ?>%;">
                    <?php
                    $row = count($label);
                    for ($s = 0; $s < $row; $s++) {
                        if ($process[$s] == 'oc1') {
                            $color_cab = '#DC4646';
                        } elseif ($process[$s] == 'oc2') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc3') {
                            $color_cab = '#1340FF';
                        } elseif ($process[$s] == 'oc1, ') {
                            $color_cab  = '#DC4646';
                        } elseif ($process[$s] == 'oc1<br>') {
                            $color_cab  = '#DC4646';
                        } elseif ($process[$s] == 'oc2, ') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc2<br>') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc3, ') {
                            $color_cab  = '#1340FF';
                        } elseif ($process[$s] == 'oc3<br>') {
                            $color_cab  = '#1340FF';
                        } else {
                            $color_cab = '#000';
                        }
                    ?>
                        <span style="padding: 0px; color: <?= $color_cab ?>;"><?= $label[$s] ?></span>
                    <?php
                    }
                    ?>
                </button>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- tbi image -->
<br>
<hr>
<br>
<!-- uk image -->
<div class="row">
    <div class="col-12">
        <div class="containere">
            <img src="../art/<?= $code_type ?>/uk.<?= $format ?>" style="width:100%; opacity: 60%;">
            <?php
            $c_code_type = $code_type;
            $c_image = "uk";
            $qtbo = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_fetch_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND b.c_code_type = '$c_code_type' AND b.c_image = '$c_image'");
            while ($dtbo = mysqli_fetch_array($qtbo)) {
                $label_get = array();
                $label = array();
                $process_get = array();
                $process = array();
                $qtbolab = mysqli_query($connect_pro, "SELECT c_number_ng, c_process FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$dtbo[c_code_coordinate]'");

                while ($dtbolab = mysqli_fetch_array($qtbolab)) {
                    array_push($label_get, $dtbolab['c_number_ng']);
                    array_push($process_get, $dtbolab['c_process']);
                }
                $cnt = count($label_get);
                foreach ($label_get as $key => $val) {
                    if (($key + 1) == $cnt) {
                        array_push($label, $val);
                    } else {
                        array_push($label, $val . ', ');
                    }

                    if (($key + 1) % 2 == 0) {
                        array_push($label, '<br>');
                    }
                }

                $cnt2 = count($process_get);
                foreach ($process_get as $key2 => $val2) {
                    if (($key2 + 1) == $cnt2) {
                        array_push($process, $val2);
                    } else {
                        array_push($process, $val2 . ', ');
                    }

                    if (($key2 + 1) % 2 == 0) {
                        array_push($process, '<br>');
                    }
                }

            ?>
                <button class="btn ingpo" style="width: 25px; border-color: #000000; height: 25px; top: <?= $dtbo['c_top'] ?>%; left: <?= $dtbo['c_left'] ?>%;">
                    <?php
                    $row = count($label);
                    for ($s = 0; $s < $row; $s++) {
                        if ($process[$s] == 'oc1') {
                            $color_cab = '#DC4646';
                        } elseif ($process[$s] == 'oc2') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc3') {
                            $color_cab = '#1340FF';
                        } elseif ($process[$s] == 'oc1, ') {
                            $color_cab  = '#DC4646';
                        } elseif ($process[$s] == 'oc1<br>') {
                            $color_cab  = '#DC4646';
                        } elseif ($process[$s] == 'oc2, ') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc2<br>') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc3, ') {
                            $color_cab  = '#1340FF';
                        } elseif ($process[$s] == 'oc3<br>') {
                            $color_cab  = '#1340FF';
                        } else {
                            $color_cab = '#000';
                        }
                    ?>
                        <span style="padding: 0px; color: <?= $color_cab ?>;"><?= $label[$s] ?></span>
                    <?php
                    }
                    ?>
                </button>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- uk image -->
<br>
<hr>
<br>
<!-- b image -->
<div class="row">
    <div class="col-12">
        <div class="containere">
            <img src="../art/<?= $code_type ?>/b.<?= $format ?>" style="width:100%; opacity: 60%;">
            <?php
            $c_code_type = $code_type;
            $c_image = "b";
            $qtbo = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_fetch_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND b.c_code_type = '$c_code_type' AND b.c_image = '$c_image'");
            while ($dtbo = mysqli_fetch_array($qtbo)) {
                $label_get = array();
                $label = array();
                $process_get = array();
                $process = array();
                $qtbolab = mysqli_query($connect_pro, "SELECT c_number_ng, c_process FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$dtbo[c_code_coordinate]'");

                while ($dtbolab = mysqli_fetch_array($qtbolab)) {
                    array_push($label_get, $dtbolab['c_number_ng']);
                    array_push($process_get, $dtbolab['c_process']);
                }
                $cnt = count($label_get);
                foreach ($label_get as $key => $val) {
                    if (($key + 1) == $cnt) {
                        array_push($label, $val);
                    } else {
                        array_push($label, $val . ', ');
                    }

                    if (($key + 1) % 2 == 0) {
                        array_push($label, '<br>');
                    }
                }

                $cnt2 = count($process_get);
                foreach ($process_get as $key2 => $val2) {
                    if (($key2 + 1) == $cnt2) {
                        array_push($process, $val2);
                    } else {
                        array_push($process, $val2 . ', ');
                    }

                    if (($key2 + 1) % 2 == 0) {
                        array_push($process, '<br>');
                    }
                }

            ?>
                <button class="btn ingpo" style="width: 25px; border-color: #000000; height: 25px; top: <?= $dtbo['c_top'] ?>%; left: <?= $dtbo['c_left'] ?>%;">
                    <?php
                    $row = count($label);
                    for ($s = 0; $s < $row; $s++) {
                        if ($process[$s] == 'oc1') {
                            $color_cab = '#DC4646';
                        } elseif ($process[$s] == 'oc2') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc3') {
                            $color_cab = '#1340FF';
                        } elseif ($process[$s] == 'oc1, ') {
                            $color_cab  = '#DC4646';
                        } elseif ($process[$s] == 'oc1<br>') {
                            $color_cab  = '#DC4646';
                        } elseif ($process[$s] == 'oc2, ') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc2<br>') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc3, ') {
                            $color_cab  = '#1340FF';
                        } elseif ($process[$s] == 'oc3<br>') {
                            $color_cab  = '#1340FF';
                        } else {
                            $color_cab = '#000';
                        }
                    ?>
                        <span style="padding: 0px; color: <?= $color_cab ?>;"><?= $label[$s] ?></span>
                    <?php
                    }
                    ?>
                </button>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- b image -->
<br>
<hr>
<br>
<!-- bb image -->
<div class="row">
    <div class="col-12">
        <div class="containere">
            <img src="../art/<?= $code_type ?>/bb.<?= $format ?>" style="width:100%; opacity: 60%;">
            <?php
            $c_code_type = $code_type;
            $c_image = "bb";
            $qtbo = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_fetch_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND b.c_code_type = '$c_code_type' AND b.c_image = '$c_image'");
            while ($dtbo = mysqli_fetch_array($qtbo)) {
                $label_get = array();
                $label = array();
                $process_get = array();
                $process = array();
                $qtbolab = mysqli_query($connect_pro, "SELECT c_number_ng, c_process FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$dtbo[c_code_coordinate]'");

                while ($dtbolab = mysqli_fetch_array($qtbolab)) {
                    array_push($label_get, $dtbolab['c_number_ng']);
                    array_push($process_get, $dtbolab['c_process']);
                }
                $cnt = count($label_get);
                foreach ($label_get as $key => $val) {
                    if (($key + 1) == $cnt) {
                        array_push($label, $val);
                    } else {
                        array_push($label, $val . ', ');
                    }

                    if (($key + 1) % 2 == 0) {
                        array_push($label, '<br>');
                    }
                }

                $cnt2 = count($process_get);
                foreach ($process_get as $key2 => $val2) {
                    if (($key2 + 1) == $cnt2) {
                        array_push($process, $val2);
                    } else {
                        array_push($process, $val2 . ', ');
                    }

                    if (($key2 + 1) % 2 == 0) {
                        array_push($process, '<br>');
                    }
                }

            ?>
                <button class="btn ingpo" style="width: 25px; border-color: #000000; height: 25px; top: <?= $dtbo['c_top'] ?>%; left: <?= $dtbo['c_left'] ?>%;">
                    <?php
                    $row = count($label);
                    for ($s = 0; $s < $row; $s++) {
                        if ($process[$s] == 'oc1') {
                            $color_cab = '#DC4646';
                        } elseif ($process[$s] == 'oc2') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc3') {
                            $color_cab = '#1340FF';
                        } elseif ($process[$s] == 'oc1, ') {
                            $color_cab  = '#DC4646';
                        } elseif ($process[$s] == 'oc1<br>') {
                            $color_cab  = '#DC4646';
                        } elseif ($process[$s] == 'oc2, ') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc2<br>') {
                            $color_cab  = '#5AA65A';
                        } elseif ($process[$s] == 'oc3, ') {
                            $color_cab  = '#1340FF';
                        } elseif ($process[$s] == 'oc3<br>') {
                            $color_cab  = '#1340FF';
                        } else {
                            $color_cab = '#000';
                        }
                    ?>
                        <span style="padding: 0px; color: <?= $color_cab ?>;"><?= $label[$s] ?></span>
                    <?php
                    }
                    ?>
                </button>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- bb image -->
<br>
<hr>
<br>