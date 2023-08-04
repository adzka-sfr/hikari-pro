<?php
require '../../config.php';

$idkar = $_POST['idkar'];
$process = $_POST['process'];
$result = $_POST['result'];

// jika inside
// Inside Check
// production/finalcheck/p/etyrpuj
if ($process == 'inside') {
    if ($result == 'Y') {
        $q1 = mysqli_query($connect, "SELECT COUNT(c_id) as total FROM t_previlege WHERE c_id = '$idkar' AND c_dir = 'production/finalcheck/p/etyrpuj'");
        $d1 = mysqli_fetch_array($q1);
        if ($d1['total'] != 0) {
            echo json_encode(array("status" => "sudah-terdaftar", "idkar" => $idkar, "process" => $process, "result" => $result));
        } else {
            $q2 = mysqli_query($connect, "INSERT INTO t_previlege SET c_id = '$idkar', c_name = 'Inside Check', c_dir = 'production/finalcheck/p/etyrpuj', c_img = 'display', c_status = 'deploy', c_project = 'Final Check UP'");
            if ($q2) {
                echo json_encode(array("status" => "berhasil-terdaftar", "idkar" => $idkar, "process" => $process, "result" => $result));
            }
        }
    } else {
        $q2 = mysqli_query($connect, "DELETE FROM t_previlege WHERE c_id = '$idkar' AND c_dir = 'production/finalcheck/p/etyrpuj'");
        if ($q2) {
            echo json_encode(array("status" => "berhasil-hapus", "idkar" => $idkar, "process" => $process, "result" => $result));
        }
    }
} elseif ($process == 'outside1') {
    if ($result == 'Y') {
        $q1 = mysqli_query($connect, "SELECT COUNT(c_id) as total FROM t_previlege WHERE c_id = '$idkar' AND c_dir = 'production/finalcheck/p/kfwqptg'");
        $d1 = mysqli_fetch_array($q1);
        if ($d1['total'] != 0) {
            echo json_encode(array("status" => "sudah-terdaftar", "idkar" => $idkar, "process" => $process, "result" => $result));
        } else {
            $q2 = mysqli_query($connect, "INSERT INTO t_previlege SET c_id = '$idkar', c_name = 'Outside Check 1', c_dir = 'production/finalcheck/p/kfwqptg', c_img = 'display', c_status = 'deploy', c_project = 'Final Check UP'");
            if ($q2) {
                echo json_encode(array("status" => "berhasil-terdaftar", "idkar" => $idkar, "process" => $process, "result" => $result));
            }
        }
    } else {
        $q2 = mysqli_query($connect, "DELETE FROM t_previlege WHERE c_id = '$idkar' AND c_dir = 'production/finalcheck/p/kfwqptg'");
        if ($q2) {
            echo json_encode(array("status" => "berhasil-hapus", "idkar" => $idkar, "process" => $process, "result" => $result));
        }
    }
} elseif ($process == 'outside2') {
    if ($result == 'Y') {
        $q1 = mysqli_query($connect, "SELECT COUNT(c_id) as total FROM t_previlege WHERE c_id = '$idkar' AND c_dir = 'production/finalcheck/p/obkjlrf'");
        $d1 = mysqli_fetch_array($q1);
        if ($d1['total'] != 0) {
            echo json_encode(array("status" => "sudah-terdaftar", "idkar" => $idkar, "process" => $process, "result" => $result));
        } else {
            $q2 = mysqli_query($connect, "INSERT INTO t_previlege SET c_id = '$idkar', c_name = 'Outside Check 2', c_dir = 'production/finalcheck/p/obkjlrf', c_img = 'display', c_status = 'deploy', c_project = 'Final Check UP'");
            if ($q2) {
                echo json_encode(array("status" => "berhasil-terdaftar", "idkar" => $idkar, "process" => $process, "result" => $result));
            }
        }
    } else {
        $q2 = mysqli_query($connect, "DELETE FROM t_previlege WHERE c_id = '$idkar' AND c_dir = 'production/finalcheck/p/obkjlrf'");
        if ($q2) {
            echo json_encode(array("status" => "berhasil-hapus", "idkar" => $idkar, "process" => $process, "result" => $result));
        }
    }
} elseif ($process == 'outside3') {
    if ($result == 'Y') {
        $q1 = mysqli_query($connect, "SELECT COUNT(c_id) as total FROM t_previlege WHERE c_id = '$idkar' AND c_dir = 'production/finalcheck/p/pkhfged'");
        $d1 = mysqli_fetch_array($q1);
        if ($d1['total'] != 0) {
            echo json_encode(array("status" => "sudah-terdaftar", "idkar" => $idkar, "process" => $process, "result" => $result));
        } else {
            $q2 = mysqli_query($connect, "INSERT INTO t_previlege SET c_id = '$idkar', c_name = 'Outside Check 3', c_dir = 'production/finalcheck/p/pkhfged', c_img = 'display', c_status = 'deploy', c_project = 'Final Check UP'");
            if ($q2) {
                echo json_encode(array("status" => "berhasil-terdaftar", "idkar" => $idkar, "process" => $process, "result" => $result));
            }
        }
    } else {
        $q2 = mysqli_query($connect, "DELETE FROM t_previlege WHERE c_id = '$idkar' AND c_dir = 'production/finalcheck/p/pkhfged'");
        if ($q2) {
            echo json_encode(array("status" => "berhasil-hapus", "idkar" => $idkar, "process" => $process, "result" => $result));
        }
    }
} else {
    echo json_encode(array("status" => "gagal", "idkar" => $idkar, "process" => $process, "result" => $result));
}
