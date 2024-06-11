<?php

  include("./dbconn.php");

  $id = mysqli_real_escape_string($conn, trim($_POST["id"]));
  $pw = mysqli_real_escape_string($conn, trim($_POST["pw"]));

  if(!$id || !pw){
    echo "<script>('아이디나 비밀번호에 공백이 있으면 안됩니다.')</script>";
    echo "<script>lacation.replace('../login.html')</script>";
    exit;
  };

  

?>