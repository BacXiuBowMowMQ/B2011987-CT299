
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qlbhang";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

        $id=isset($_COOKIE["id"])?$_COOKIE["id"]:"id_undefine";

        $sql = "select * from customers where id= '$id'";
    
        $result = $conn->query($sql);
        
        $result_all=$result->fetch_all();
        $arr_info=[];
        echo"<pre>";
         print_r($result_all);
        echo "</pre>";
        echo count($result_all);
        if(count($result_all)>0){
            foreach($result_all as $items){
                $arr_info["gmail"]=$items[2];
                $arr_info["password"]=$items[5];
            }
        }else{
            header("Location: Homepage.php");
        }

        $errors=[];

        if(isset($_POST["submit_password"])){

            if(md5(trim($_POST['mk_old']))!=$arr_info['password']){
                $errors["old_pw"]["value"]="Mat khau khong trung khop";
            }
            else if(strlen(trim($_POST['mk_new']))<=5){
                $errors["new_pw"]["length"]="mk pai co it nhat 6 ky tu";
            }
            else if(trim($_POST['mk_new'])!=trim($_POST['mk_confirm'])){
                $errors["confirm_pw"]["confirm"]="mat khau khong trung khop";
            }

            if(count($errors)==0){
                $sql_2="UPDATE `customers` SET `password` = '".md5($_POST['mk_new'])."' WHERE `customers`.`id` = $id";
                if ($conn->query($sql_2) == TRUE) {
                    echo "<h3 style='color:green;'>Thay đổi mật khẩu thành công </h3>";
                  } else {
                    echo "Error: " . $sql_2 . "<br>" . $conn->error;
                  }
            }
        }

$conn->close();
?>
<body>
    <h2 style="font-size:15px;">Đổi mật khẩu tài khoản: <?php echo isset($arr_info['gmail'])?$arr_info['gmail']:null ?></h2> 
    <form action="" method="post">
        <input type="text" name="mk_old" placeholder="Nhập mật khẩu cũ"><span style="color:red;">
        <?php echo isset($errors["old_pw"]["value"]) ? $errors["old_pw"]["value"] : false ?></span><br>

        <input type="text" name="mk_new" placeholder="Nhập mật khẩu mới"><span style="color:red;">
        <?php echo isset($errors["new_pw"]["length"]) ? $errors["new_pw"]["length"] : false ?></span><br>

        <input type="text" name="mk_confirm" placeholder="Xác nhận mật khẩu mới"><span style="color:red;">
        <?php echo isset($errors["confirm_pw"]["confirm"]) ? $errors["confirm_pw"]["confirm"] : false ?></span><br>
        <input type="submit" name="submit_password" value="xác nhận">
    </form>
</body>
</html>
