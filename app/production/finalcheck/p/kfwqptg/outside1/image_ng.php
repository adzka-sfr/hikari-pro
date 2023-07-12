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
            $c_code_coordinate = $code_type . "tbo";
            $qtbo = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_fetch_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND a.c_code_coordinate LIKE '$c_code_coordinate%'");
            while ($dtbo = mysqli_fetch_array($qtbo)) {
                $label_get = array();
                $label = array();
                $qtbolab = mysqli_query($connect_pro, "SELECT c_number_ng FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$dtbo[c_code_coordinate]'");

                while ($dtbolab = mysqli_fetch_array($qtbolab)) {
                    array_push($label_get, $dtbolab['c_number_ng']);
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

            ?>
                <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $dtbo['c_top'] ?>%; left: <?= $dtbo['c_left'] ?>%;">
                    <span style="color: red; padding: 0px;"><?php foreach ($label as $key) {
                                                                echo $key;
                                                            } ?></span>
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
            $c_code_coordinate = $code_type . "tbi";
            $qtbi = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_fetch_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND a.c_code_coordinate LIKE '$c_code_coordinate%'");
            while ($dtbi = mysqli_fetch_array($qtbi)) {
                $label_get = array();
                $label = array();
                $qtbilab = mysqli_query($connect_pro, "SELECT c_number_ng FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$dtbi[c_code_coordinate]'");

                while ($dtbilab = mysqli_fetch_array($qtbilab)) {
                    array_push($label_get, $dtbilab['c_number_ng']);
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
            ?>
                <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $dtbi['c_top'] ?>%; left: <?= $dtbi['c_left'] ?>%;">
                    <span style="color: red; padding: 0px;"><?php foreach ($label as $key) {
                                                                echo $key;
                                                            } ?></span>
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
            $c_code_coordinate = $code_type . "uk";
            $quk = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_fetch_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND a.c_code_coordinate LIKE '$c_code_coordinate%'");
            while ($duk = mysqli_fetch_array($quk)) {
                $label_get = array();
                $label = array();
                $quklab = mysqli_query($connect_pro, "SELECT c_number_ng FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$duk[c_code_coordinate]'");

                while ($duklab = mysqli_fetch_array($quklab)) {
                    array_push($label_get, $duklab['c_number_ng']);
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
            ?>
                <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $duk['c_top'] ?>%; left: <?= $duk['c_left'] ?>%;">
                    <span style="color: red; padding: 0px;"><?php foreach ($label as $key) {
                                                                echo $key;
                                                            } ?></span>
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
            $c_code_coordinate = $code_type . "b";
            $qb = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_fetch_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND a.c_code_coordinate LIKE '$c_code_coordinate%'");
            while ($db = mysqli_fetch_array($qb)) {
                $label_get = array();
                $label = array();
                $qblab = mysqli_query($connect_pro, "SELECT c_number_ng FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$db[c_code_coordinate]'");

                while ($dblab = mysqli_fetch_array($qblab)) {
                    array_push($label_get, $dblab['c_number_ng']);
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
            ?>
                <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $db['c_top'] ?>%; left: <?= $db['c_left'] ?>%;">
                    <span style="color: red; padding: 0px;"><?php foreach ($label as $key) {
                                                                echo $key;
                                                            } ?></span>
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
            $c_code_coordinate = $code_type . "bb";
            $qbb = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_fetch_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND a.c_code_coordinate LIKE '$c_code_coordinate%'");
            while ($dbb = mysqli_fetch_array($qbb)) {
                $label_get = array();
                $label = array();
                $qbblab = mysqli_query($connect_pro, "SELECT c_number_ng FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$dbb[c_code_coordinate]'");

                while ($dbblab = mysqli_fetch_array($qbblab)) {
                    array_push($label_get, $dbblab['c_number_ng']);
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
            ?>
                <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $dbb['c_top'] ?>%; left: <?= $dbb['c_left'] ?>%;">
                    <span style="color: red; padding: 0px;"><?php foreach ($label as $key) {
                                                                echo $key;
                                                            } ?></span>
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