<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$location = $_SESSION['role'];
$today = date('Y-m-d', strtotime($now));

// data lemparan
$c_acard = $_POST['acard'];
$c_action = "packing";
$c_serialbench = $_POST['serialbench'];
$c_serialuserp = $_POST['serialuserp'];
$c_namebench = $_POST['namebench'];
$c_nameuserp = $_POST['nameuserp'];
$c_gmcbench = $_POST['gmcbench'];
$c_gmcuserp = $_POST['gmcuserp'];
$c_qty = $_POST['qtypiano'];
$c_serialpiano = $_POST['serialpiano'];
$c_namepiano = $_POST['namepiano'];
$c_gmcpiano = $_POST['gmcpiano'];
$c_pic = $_SESSION['id'];
$c_date = $now;
$c_location = $location;

/// # image

// function compressImage($source, $destination, $quality)
// {
//     // Get image info 
//     $imgInfo = getimagesize($source);
//     $mime = $imgInfo['mime'];

//     // Create a new image from file 
//     switch ($mime) {
//         case 'image/jpeg':
//             $image = imagecreatefromjpeg($source);
//             break;
//         case 'image/png':
//             $image = imagecreatefrompng($source);
//             break;
//         case 'image/gif':
//             $image = imagecreatefromgif($source);
//             break;
//         default:
//             $image = imagecreatefromjpeg($source);
//     }

//     // Save image 
//     imagejpeg($image, $destination, $quality);

//     // Return compressed image 
//     return $destination;
// }

// function convert_filesize($bytes, $decimals = 2)
// {
//     $size = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
//     $factor = floor((strlen($bytes) - 1) / 3);
//     return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
// }

//////////////////////////////////////////////////////////
// File upload path 
// $uploadPath = "uploads/";

// $statusMsg = '';
// $status = 'danger';

// // custom name
// $fileName = basename(strtotime($now) . ".jpg");
// $fileNamedel = strtotime($now) . ".jpg";

// // name based file
// // $fileName = basename($_FILES["image"]["name"]);

// $imageUploadPath = $uploadPath . $fileName;
// $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);

// // Allow certain file formats 
// $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
// if (in_array($fileType, $allowTypes)) {
//     // Image temp source and size 
//     $imageTemp = $_FILES["jepretan"]["tmp_name"];
//     $imageSize = convert_filesize($_FILES["jepretan"]["size"]);

//     // Compress size and upload image 
//     $compressedImage = compressImage($imageTemp, $imageUploadPath, 20);

//     if ($compressedImage) {
//         $compressedImageSize = filesize($compressedImage);
//         $compressedImageSize = convert_filesize($compressedImageSize);

//         $status = 'success';
//         $statusMsg = "Image compressed successfully.";
//     } else {
//         $statusMsg = "Image compress failed!";
//     }
// } else {
//     $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
// }

// persiapan untuk upload
// $imgData = file_get_contents($compressedImage);
// $imgType = $_FILES['jepretan']['type'];
// $imgSerialPiano = $c_serialpiano;
// $imgRegister = $now;

// upload
// $sql = "INSERT INTO qa_packing_image(imageType ,imageData, imageSerialPiano, imageRegister) VALUES(?, ?, ?, ?)";
// $statement = $connect_pro->prepare($sql);
// $statement->bind_param('ssss', $imgType, $imgData, $imgSerialPiano, $imgRegister);
// $current_id = $statement->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
// // untuk hapus file pasca insert blob
// unlink("uploads/" . $fileNamedel);
// // }

/// # image

// cek isi
if ($c_serialbench == '') {
    $c_serialbench = '-';
}
if ($c_namebench == '') {
    $c_namebench = '-';
}
if ($c_gmcbench == '') {
    $c_gmcbench = '-';
}
if ($c_serialuserp == '') {
    $c_serialuserp = '-';
}
if ($c_nameuserp == '') {
    $c_nameuserp = '-';
}
if ($c_gmcuserp == '') {
    $c_gmcuserp = '-';
}

$sql = mysqli_query($connect_pro, "INSERT INTO qa_log SET c_action = '$c_action', c_serialbench = '$c_serialbench', c_namebench = '$c_namebench', c_gmcbench = '$c_gmcbench', c_serialuserp = '$c_serialuserp', c_nameuserp = '$c_nameuserp', c_gmcuserp = '$c_gmcuserp', c_qty = $c_qty, c_acard = '$c_acard', c_serialpiano = '$c_serialpiano', c_namepiano = '$c_namepiano', c_gmcpiano = '$c_gmcpiano', c_pic = '$c_pic', c_date = '$c_date', c_location = '$c_location'");
if ($sql) {
    // update qa_bench (bench sudah digunakan)
    $sql1 = mysqli_query($connect_pro, "UPDATE qa_bench SET c_packed = '$now' WHERE c_serialbench = '$c_serialbench'");
    // update qa_userp (userp sudah digunakan)
    $sql2 = mysqli_query($connect_pro, "UPDATE qa_userp SET c_packed = '$now' WHERE c_serialuserp = '$c_serialuserp'");
    // echo "packing-berhasil";
    echo json_encode(array("status" => "packing-berhasil"));
} else {
    // echo "error";
    echo json_encode(array("status" => "error"));
}
