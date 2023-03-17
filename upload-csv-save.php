<?php

$myfile=fopen('data.csv','a');

if(isset($_POST['submit'])) {
  // Lấy tập tin được upload
  $file = $_FILES['file']['tmp_name'];
  // Mở tập tin
  $handle = fopen($file, "r");

  // Đọc nội dung tập tin vào một mảng
  
  while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

    // Xử lý dữ liệu (chuyển về dạng SQL, lưu vào CSDL, ...)

    $id = $data[0];
    $fullname = $data[1];
    $email = $data[2];
    $birthday = $data[3];
    $reg_date= $data[4];
    $password = $data[5];
    $img_profile = $data[6];

    $content=$id.";". $fullname.";". $email.";". $birthday.";". $reg_date.";". $password.";". $img_profile."\n";

    fwrite($myfile,$content);

  }
  // Đóng tập tin
  fclose($handle);
}
fclose($myfile); 

    header("location: upload-csv.php");

?>
