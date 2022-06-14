<?php
// setting default timezone
date_default_timezone_set('Asia/Jakarta');
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "hikari";

// Create connection
$connect = new mysqli($servername, $username, $password, $db);

// Check connection
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

//fungsi base_url
function base_url($url = null)
{
  $base_url = "http://localhost/training/hikari";
  if ($url != null) {
    return $base_url . "/" . $url;
  } else {
    return $base_url;
  }
}

// login
if (isset($_POST['login'])) {
  $id = trim(mysqli_real_escape_string($connect, $_POST['id']));
  $pass = trim(mysqli_real_escape_string($connect, $_POST['pass']));
  $sql_login = mysqli_query($connect, "SELECT * FROM auth WHERE id = '$id' AND pass = '$pass'") or die(mysqli_error($connect));
  $cek_nama = mysqli_fetch_array($sql_login);
  if (mysqli_num_rows($sql_login) > 0) {
    $_SESSION['id'] = $id;
    $_SESSION['nama'] = $cek_nama['nama'];
    echo "<script>window.location='" . base_url() . "';</script>";
  } else { ?>
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3">
        <div class="alert alert-danger alert-dismissable" role="alert">
          <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
          <span align: "center" ; class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <strong>Login gagal!</strong> Id / Password Salah
        </div>
      </div>
    </div>
<?php
  }
}
?>