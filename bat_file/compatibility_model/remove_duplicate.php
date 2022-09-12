<?php
include_once 'koneksi.php';

$b450_s = mysqli_query($connect, "SELECT waktu, COUNT(waktu) FROM sd_b450 GROUP BY waktu HAVING COUNT(waktu) > 1; ");
while ($b450_d = mysqli_fetch_array($b450_s)) {
    mysqli_query($connect, "DELETE from sd_b450 where waktu = '$b450_d[waktu]' limit 1");
}

$b440_s = mysqli_query($connect, "SELECT waktu, COUNT(waktu) FROM sd_b440 GROUP BY waktu HAVING COUNT(waktu) > 1; ");
while ($b440_d = mysqli_fetch_array($b440_s)) {
    mysqli_query($connect, "DELETE from sd_b440 where waktu = '$b440_d[waktu]' limit 1");
}

$u200_s = mysqli_query($connect, "SELECT waktu, COUNT(waktu) FROM sd_u200 GROUP BY waktu HAVING COUNT(waktu) > 1; ");
while ($u200_d = mysqli_fetch_array($u200_s)) {
    mysqli_query($connect, "DELETE from sd_u200 where waktu = '$u200_d[waktu]' limit 1");
}
