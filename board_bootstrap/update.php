<!-- update.php -->

<?php
  include("./php/dbconn.php");

  // view.php 에서 넘겨진 id 값을 받아서 출력

  // $id = $_GET['id'];
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  // echo $id;

  $sql = "select * from free_board where id = '$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  // echo $row[0] . "id 변경 불가능<br>";
  // echo $row[1] . "제목 변경 가능<br>";
  // echo $row[2] . "이름 변경 불가능<br>";
  // echo $row[3] . "내용 변경 가능<br>";
  // echo $row[4] . "패스워드 변경 가능<br>";
  // echo date("Y-m-d", strtotime($row[5])) . "날짜 자동 변경<br>";

?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>자유게시판 - 글 수정하기</title>
  <!-- 1. CDN 방식으로 연결하기 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- 부트스트랩 아이콘 CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    main{max-width: 1200px; width: 100%; margin: 0 auto; box-sizing: border-box;}
    section{max-width: calc(1200px - 5%); width: 95%; margin: 0 auto;}
    table{width: 95%;}
    h2{margin-block: 30px;}
    caption{display: none;}
    textarea{resize: none;}
    footer{text-align: center; margin-block: 30px;}
  </style>
</head>
<body>
  <form name="글 수정하기" method="post" action="./php/update_input.php" onsubmit="return formCheck();">
  <input type="hidden" name="id" value="<?php echo $row['id']?>">
    <section>
      <h2 class="text-center">게시판 글 수정하기</h2>

      <table class="table table-striped">
        <caption>글 수정하기</caption>
        <thead>
          <tr>
            <td scope="row"><label for="subject">제목</label></td>
            <td scope="row"><input type="text" name="subject" id="subject" maxlength="255" autofocus value="<?php  echo $row[1] ?>" class="form-control"></td>
            <!-- 스크립트 안할 경우 'required' 넣어줄 것 -->
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><label for="name">작성자</label></td>
            <td><input type="text" name="name" id="name" maxlength="50" value="<?php  echo $row[2] ?>" readonly class="form-control"></td>
          </tr>
          <tr>
            <td><label for="memo">내용</label></td>
            <td><textarea name="memo" id="memo" cols="50" rows="20" class="form-control"><?php  echo $row[3] ?></textarea></td>
          </tr>
          <tr class=text-center>
            <td colspan="2">
              <a href="./list.php" title="글 목록" class="btn btn-light">글 목록</a>
            </td>
          </tr>
          <tr>
            <td><label for="pwd" class="form-label">비밀번호</label></td>
            <td><input type="password" id="pwd" name="pwd" autoComplete="off" class="form-control"></td>
          </tr>
          <tr class="text-center">
            <td colspan="2">
            <input type="submit" value="수정하기" class="btn btn-success">
            <input type="reset" value="입력 취소" class="btn btn-dark">
            </td>
          </tr>
        </tfoot>
      </table>

    </section>
  </form>

  <!-- 유효성검사 -->
  <script>
    function formCheck(){
      // alert(document.getElementById('subject').value);
      
      // 작성자명 체크
      let subject = document.getElementById('subject');
      let name = document.getElementById('name');
      let memo = document.getElementById('memo');
      let pwd = document.getElementById('pwd');

      if(subject.value.trim() == ''){
        alert('제목을 입력해주세요.');
        subject.focus();
        return false;
      }
      if(memo.value.trim() == ''){
        alert('내용을 입력해주세요.');
        memo.focus();
        return false;
      }
      if(pwd.value.trim() == ''){
        alert('비밀번호를 입력해주세요.');
        pwd.focus();
        return false;
      }
      return true;
    };
  </script>
  
<?php include("./php/footer.php"); ?>