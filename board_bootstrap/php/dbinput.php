<!-- dbinput.php -->
<?php

  include('./dbconn.php');
  date_default_timezone_set('Asia/Seoul');    // 서울 기준으로 서버 시간 설정

  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $subject = mysqli_real_escape_string($conn, $_POST['subject']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $memo = mysqli_real_escape_string($conn, nl2br($_POST['memo']));
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

  /* 
    mysqli_real_escape_string
    php에서 제공하는 함수로, MYSQL과 커넥션을 할 때 string을 Escape한 상태로 만들어주는 함수
    string을 입력할 때 kim's person 처럼 sql문에 앞서 있던 ' 기호와 중첩이 될 수 있다. 이러한 문제를 해결하기 위해 \n, \r \" 처럼 구별해주는 형태로 만들어주는 것을 

    select * from table where ''
  */

  $datetime = date('Y-m-d');

  // 입력한 비밀번호를 password()함수를 사용해서 암호화해서 가져옴
  // $pwd = password('$pwd');
  $pwd = password_hash($pwd, PASSWORD_DEFAULT);

  // 값 출력하기
  // echo $id . '<br>';
  // echo $subject . '<br>';
  // echo $name . '<br>';
  // echo $memo . '<br>';
  // echo $pwd . '<br>';
  // echo $datetime . '<br>';

  // 사용자 아이피 주소
  $ip = $_SERVER['REMOTE_ADDR'];    // 사용자가 접속한 IP주소를 가져옴.
  // echo $ip;

  // DB INSERT문을 사용하여 데이터에 자료 입력하기
  $sql = "insert into free_board(id, subject, name, memo, pwd, datetime, ip) value('0', '$subject', '$name', '$memo', '$pwd', '$datetime', '$ip')";

  // echo '입력완료';

  $result = mysqli_query($conn, $sql);
  
  if($result){   // 정상적으로 실행이 됐다면
    echo "<script>alert('게시글 작성이 완료되었습니다.');</script>";
    echo "<script>location.replace('../list.php');</script>";
    exit;
  } else{
    echo "글 입력 실패 : " . mysqli_error($conn);
    mysqli_close($conn);
  }

?>