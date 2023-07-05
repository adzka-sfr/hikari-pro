<?php

$con_prodinfo = mysqli_connect("localhost","root","","prod_info");

// connection database prod_info
if (mysqli_connect_errno()){
    echo "Koneksi database gagal : " . mysqli_connect_error();
}

date_default_timezone_set('Asia/Jakarta');

 
if ($_GET['page']=='addplan'){
include "add_plan.php"; 
}elseif ($_GET['page']=='addplanstuffing'){
include "add_planstuffing_temp.php";
}elseif ($_GET['page']=='viewplan'){
  include "view_plan_detail_dev.php";
}elseif ($_GET['page']=='stckfg'){
  include "grafikstock_fg1.php";
}elseif ($_GET['page']=='prostuffing'){
  include "progres_stuffing.php";
}elseif ($_GET['page']=='stuffing_acvmt'){
  include "stuffing_achieve.php";
}elseif ($_GET['page']=='sales_acvmt'){
  include "sales_achieve.php";
}elseif ($_GET['page']=='add_shipping'){
  include "add_shippingplan_temp.php";
}elseif ($_GET['page']=='upload_shipping'){
  include "add_shippingplan_upload.php";
}elseif ($_GET['page']=='booking_remain'){
  include "container_booking.php";
}elseif ($_GET['page']=='booking_prog'){
  include "progres_bookcontainer.php";
}elseif ($_GET['page']=='esodso'){
  include "add_fifostuffing.php";
}elseif ($_GET['page']=='esoinfo'){
  include "eso-info.php";
}elseif ($_GET['page']=='welcome'){
  include "welcome_page.php"; 
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
