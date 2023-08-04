<?php
require '../../config.php';
$serialnumber = $_POST['serialnumber'];
$q1 = mysqli_query($connect_pro, "SELECT a.c_serialnumber, b.c_name, c.c_repair_outsidetiga_o FROM finalcheck_register a INNER JOIN finalcheck_list_piano b ON a.c_gmc = b.c_gmc INNER JOIN finalcheck_repairtime c ON a.c_serialnumber = c.c_serialnumber WHERE a.c_serialnumber = '$serialnumber'");
$d1 = mysqli_fetch_array($q1);
?>

<tr>
    <td>1</td>
    <td><?= $d1['c_serialnumber'] ?></td>
    <td style="text-align: left;"><?= $d1['c_name'] ?></td>
    <td><?= $d1['c_repair_outsidetiga_o'] ?></td>
    <td></td>
</tr>