<?php

$mysql_host = "localhost";    // 호스트명
$mysql_user = "root";         // 사용자명
$mysql_password = "1234";     // 비밀번호
$mysql_db = "product";        // 데이터베이스명

  // 데이터베이스 연결을 위한 변수 생성
  $conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

  // 데이터베이스 연결 확인
  if(!$conn){
    die('연결실패 : ' .mysqli_connect_error());
  };

  session_start();   // 세션 시작

?>