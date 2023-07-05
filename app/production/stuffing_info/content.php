<?php

$con_prodinfo = mysqli_connect("localhost","root","","prod_info");

// connection database prod_info
if (mysqli_connect_errno()){
    echo "Koneksi database gagal : " . mysqli_connect_error();
}

date_default_timezone_set('Asia/Jakarta');

 
if ($_GET['page']=='welcome'){
  include "r_stuffing_daily_up.php";
}elseif ($_GET['page']=='daily_up'){
  include "r_stuffing_daily_up.php"; 
}elseif ($_GET['page']=='daily_gp'){
  include "r_stuffing_daily_gp.php"; 
}elseif ($_GET['page']=='monthly'){
  include "r_stuffing_dashboard_montly.php"; 
}elseif ($_GET['page']=='bydestin'){
  include "r_stuffing_bydestin.php"; 
}elseif ($_GET['page']=='prog_sales'){
  include "sales_progres.php";
}elseif ($_GET['page']=='monthly_arcv'){
  include "form_monthly_arcv.php";
}
//elseif ($_GET['page']=='prosesupload'){
//include "prosesupload.php"; 
//}
// Apabila modul tidak ditemukan
else{
  echo "<p><b>WELCOME TO THE JUNGLE</b></p></br>"; 
  echo "<p><b>Please select the tree you want in the menu column</b></p></br>"; 
}
?>
