                                    <?php
                                    session_start();
                                    date_default_timezone_set('Asia/Jakarta');
                                    $connect_pro = new mysqli("localhost", "root", "", "hikari_project");
                                    $v_picrepair = $_SESSION['repair_name'];
                                    $v_serial = $_POST['v_serial'];
                                    $v_section = $_POST['v_section'];
                                    #===================================================================#

                                    $date_in = date('Y-m-d H:i:s');
                                    $pp1 = "UPDATE formng_resultro SET c_repairdate = '$date_in', c_picrepair = '$v_picrepair' WHERE c_serialnumber = '$v_serial' AND c_section = '$v_section' AND c_picrepair = ''";

                                    if (mysqli_query($connect_pro, $pp1)) {
                                        // update pada resulto1 dengan membedakan query berdasarkan proses yang aktif (oc1, oc2, oc3)
                                        // oc1
                                        if ($_SESSION['last_process'] == 'oc1') {
                                            $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resultro WHERE c_serialnumber ='$v_serial' AND c_process = '$_SESSION[last_process]' AND c_section = '$v_section'");
                                            while ($data2 = mysqli_fetch_array($sql2)) {
                                                if (!empty($data2['c_picrepair'])) {
                                                    $pp1 = mysqli_query($connect_pro, "UPDATE formng_resulto1 SET c_repairdate1 = '$data2[c_repairdate]', c_repair1 = '$data2[c_picrepair]' WHERE c_serialnumber = '$data2[c_serialnumber]' AND c_areacode = '$data2[c_areacode]' AND c_cabinet = '$data2[c_cabinet]' AND c_ng1 = '$data2[c_ng]'");
                                                }
                                            }
                                        }

                                        // oc2
                                        if ($_SESSION['last_process'] == 'oc2') {
                                            $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resultro WHERE c_serialnumber ='$v_serial' AND c_process = '$_SESSION[last_process]' AND c_section = '$v_section'");
                                            while ($data2 = mysqli_fetch_array($sql2)) {
                                                if (!empty($data2['c_picrepair'])) {
                                                    $pp1 = mysqli_query($connect_pro, "UPDATE formng_resulto1 SET c_repairdate2 = '$data2[c_repairdate]', c_repair2 = '$data2[c_picrepair]' WHERE c_serialnumber = '$data2[c_serialnumber]' AND c_areacode = '$data2[c_areacode]' AND c_cabinet = '$data2[c_cabinet]' AND c_ng2 = '$data2[c_ng]'");
                                                }
                                            }
                                        }

                                        // oc2
                                        if ($_SESSION['last_process'] == 'oc3') {
                                            $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resultro WHERE c_serialnumber ='$v_serial' AND c_process = '$_SESSION[last_process]' AND c_section = '$v_section'");
                                            while ($data2 = mysqli_fetch_array($sql2)) {
                                                if (!empty($data2['c_picrepair'])) {
                                                    $pp1 = mysqli_query($connect_pro, "UPDATE formng_resulto1 SET c_repairdate3 = '$data2[c_repairdate]', c_repair3 = '$data2[c_picrepair]' WHERE c_serialnumber = '$data2[c_serialnumber]' AND c_areacode = '$data2[c_areacode]' AND c_cabinet = '$data2[c_cabinet]' AND c_ng3 = '$data2[c_ng]'");
                                                }
                                            }
                                        }

                                        // kembali ke studio
                                        echo json_encode(array("statusCode" => 200));
                                    } else {
                                        echo json_encode(array("statusCode" => 201));
                                    }
                                    mysqli_close($connect_pro);
                                    ?>