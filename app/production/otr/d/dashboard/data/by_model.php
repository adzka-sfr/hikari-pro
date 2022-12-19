<?php
// mengambil data distinct model dari tabel 16 jam
$sql_model = mysqli_query($con_pro, "SELECT DISTINCT(model) as model from ongoing_slip order by model asc");
