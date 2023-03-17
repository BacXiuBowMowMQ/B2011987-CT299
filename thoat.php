<?php 
session_start();
session_unset();
session_destroy();


setcookie("user","", time() - (86400 / 24), "/");
setcookie("fullname","", time() - (86400 / 24), "/");
setcookie("id","", time() - (86400 / 24), "/");

header("Location: login.php");

?>