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
    $lista = '';
} else {
    $lista = $_POST['isiap'];
}

$sql = mysqli_query($connect_pro, "SELECT * from formng_itemnginside WHERE c_code = '$lista'");
?>

<option disabled selected value="">Select NG from below</option>
<?php
while ($data = mysqli_fetch_array($sql)) {
    $label_table = $data['c_ng'];
?>
    <option value="<?= $data['id'] ?>"><?= $label_table ?></option>
<?php
}
?>