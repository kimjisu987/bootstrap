<!-- delete.php -->

<?php
  include("dbconn.php");

  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

  $hash_pwd = '$2y10$'.password_hash($pwd, PASSWORD_DEFAULT);

  $sql = "SELECT pwd FROM free_board WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $view_btn = $_POST['view_btn'];

  if (!password_verify($pwd, $row['pwd'])) {
    echo "<script>alert('비밀번호가 틀렸습니다. 다시 확인하세요.');</script>";
    echo "<script>history.back(1);</script>";
    exit;
  } else {
    if($view_btn === '수정'){    // value값이 '수정'이라면
      // update 페이지로 넘어가라
      echo "<script>location.replace('../update.php?id=" . $id . "');</script>";
      exit;
    } 
    if($view_btn === '삭제'){   // value값이 '삭제'라면
      $sql = "DELETE FROM free_board WHERE id = '$id'";
      mysqli_query($conn, $sql);
      echo "<script>alert('게시글이 삭제되었습니다.');</script>";
      echo "<script>location.replace('../list.php');</script>";
      exit;
    }
  }

  mysqli_close($conn);

?>