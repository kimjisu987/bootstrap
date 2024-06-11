<!-- update_input.php -->

<?php
  include("dbconn.php");
  date_default_timezone_set('Asia/Seoul');    // 서울 기준으로 서버 시간 설정

  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $subject = mysqli_real_escape_string($conn, $_POST['subject']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $memo = mysqli_real_escape_string($conn, nl2br($_POST['memo']));
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
  $datetime = date('Y-m-d');
  $ip = $_SERVER['REMOTE_ADDR'];

  $pwd = password_hash($pwd, PASSWORD_DEFAULT);

  $sql = "update free_board
  set subject = '$subject',
      name = '$name',
      memo = '$memo',
      pwd = '$pwd',
      datetime = '$datetime'
  where id = '$id'";

  $result = mysqli_query($conn, $sql);

  if($result){
    echo "<script>alert('게시글이 수정되었습니다.');</script>";
    echo "<script>location.replace('../list.php');</script>";
    exit;
  } else{
    echo "글 입력 실패 : " . mysqli_error($conn);
    mysqli_close($conn);
  }

?>