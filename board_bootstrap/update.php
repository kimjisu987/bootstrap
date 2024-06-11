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
  <link rel="stylesheet" href="./css/board.css" type="text/css">
  <style>
    table thead tr:first-of-type{border-top: 1px solid #000;}
    .pw_box{text-align: center;}
    table input[type="password"]{
      width: 190px; height: 34px;
      box-sizing: border-box;
      border-width: 1px;
      background: #fff;
      outline-color: #215499;
      padding-inline: 15px;
      margin-inline: 10px;
    }
    tbody tr:nth-of-type(3), tbody tr:last-of-type{
      width: 100%;
      text-align: center;
    }
    table tbody tr:nth-of-type(3), table tbody tr:nth-of-type(5){border-bottom: 1px solid #000;}
    pre{
      width: 100%;
      white-space: pre-wrap;
      word-wrap: break-word;
      font-size: 14px;
      font-family: "Malgun Gothic";
    }
  </style>
</head>
<body>
  <form name="글 수정하기" method="post" action="./php/update_input.php" onsubmit="return formCheck();">
  <input type="hidden" name="id" value="<?php echo $row['id']?>">
    <section>
      <h2>게시판 글 수정하기</h2>

      <table>
        <caption>글 수정하기</caption>
        <thead>
          <tr>
            <td scope="row"><label for="subject">제목</label></td>
            <td scope="row"><input type="text" name="subject" id="subject" maxlength="255" autofocus value="<?php  echo $row[1] ?>"></td>
            <!-- 스크립트 안할 경우 'required' 넣어줄 것 -->
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><label for="name">작성자</label></td>
            <td><input type="text" name="name" id="name" maxlength="50" value="<?php  echo $row[2] ?>" readonly></td>
          </tr>
          <tr>
            <td><label for="memo">내용</label></td>
            <td><textarea name="memo" id="memo" cols="50" rows="20"><?php  echo $row[3] ?></textarea></td>
          </tr>
          <tr>
            <td colspan="2">
              <a href="./list.php" title="글 목록" class="list">글 목록</a>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="pw_box">
              <label for="pwd">비밀번호</label><input type="password" id="pwd" name="pwd" autoComplete="off">
            </td>
          </tr>
          <tr>
            <td colspan="2">
            <input type="submit" value="수정하기">
            <input type="reset" value="입력 취소">
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