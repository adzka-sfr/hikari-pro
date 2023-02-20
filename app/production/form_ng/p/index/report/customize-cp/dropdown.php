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


if (empty($_POST['isiap'])) {
    if ($_SESSION['co-page'] == 'furniture') {
        $lista = 'f-M2';
    } elseif ($_SESSION['co-page'] == 'silent') {
        $lista = 's-B1 & JU';
    } elseif ($_SESSION['co-page'] == 'polyester') {
        $lista = 'p-B1 & JU';
    }
} else {
    $lista = $_POST['isiap'];
}

$label_table = substr($lista, 2);
$sql = mysqli_query($connect_pro, "SELECT * from formng_checkcomplete WHERE c_type = '$lista'");
?>

<option disabled selected value="">Select model from below</option>
<?php
while ($data = mysqli_fetch_array($sql)) {
?>
    <option value="<?= $data['id'] ?>"><?= $label_table ?> // <?= $data['c_partname'] ?></option>
<?php
}
?>