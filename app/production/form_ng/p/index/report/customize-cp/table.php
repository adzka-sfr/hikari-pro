<?php
$servername = "localhost";
$username = "root";
$password = "";

// database
$db1 = "hikari";
$db2 = "hikari_project";
$db3 = "hikari_log";
// Create connection for main database (hikari)
$connect = new mysqli($servername, $username, $password, $db1);
// Create connection for project database (hikari_project)
$connect_pro = new mysqli($servername, $username, $password, $db2);
// Create connection for log database (hikari_log)
$connect_log = new mysqli($servername, $username, $password, $db3);


if (empty($_POST['isia'])) {
    if ($_SESSION['co-page'] == 'furniture') {
        $list = 'f-M2';
    } elseif ($_SESSION['co-page'] == 'silent') {
        $list = 's-B1 & JU';
    } elseif ($_SESSION['co-page'] == 'polyester') {
        $list = 'p-B1 & JU';
    }
} else {
    $list = $_POST['isia'];
}

$label_table = substr($list, 2);
?>
<script>
    $(document).ready(function() {
        $('#cus_fur').DataTable({
            paging: false,
            scrollY: '350px',
            scrollCollapse: true,
            "dom": '<"wrapper"flipt>'
        });
    });
</script>
<table id="cus_fur" class="table table-bordered">
    <thead style="text-align: center;">
        <th style="width:10%;">No</th>
        <th>Completeness Process (<?= $label_table ?>)</th>
    </thead>
    <tbody>
        <?php
        $no  = 0;
        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_checkcomplete WHERE c_type = '$list' order by id");
        while ($data = mysqli_fetch_array($sql)) {
            $no++;
            if ($data['c_status'] == 'disabled') {
        ?>
                <tr style="background-color: #E2E3E5;">
                    <td style="text-align: center; "><s><?= $no ?></s></td>
                    <td><s><?= $data['c_partname'] ?></s></td>
                </tr>
            <?php
            } else {
            ?>
                <tr>
                    <td style="text-align: center; "><?= $no ?></td>
                    <td><?= $data['c_partname'] ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>