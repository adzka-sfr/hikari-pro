<?php
require '../_config/koneksi.php';
// update db inventory tanggal = null, update = null, qty = 0
mysqli_query($conn, "UPDATE `inventory_fix` SET `tanggal`='NULL',`updated`='NULL', `pcs`='0'");
// update db ng_hist update = null, qty = 0
mysqli_query($conn, "UPDATE `ng_hist` SET `updated`='NULL', `qty`='0'");
// update db inventory_ng update = null, qty = 0
mysqli_query($conn, "UPDATE `inventory_ng` SET `updated`='NULL',pcs='0'");
// update db prioritas seluruh qty = 0
mysqli_query($conn, "UPDATE `prioritas` SET `pcs_inventory`='0',`pcs_plan`='0',`unit_co`='0',`pcs_prioritas`='0',`safety_stock`='0'");
// delete data planing
mysqli_query($conn, "DELETE FROM `planing`");
// delete data inventory_hist
mysqli_query($conn, "DELETE FROM `inventory_hist`");
