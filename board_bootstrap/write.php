<!-- write.php -->

<?php
  include('./php/dbconn.php');   // 데이터베이스 연결
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>자유게시판 - 글쓰기</title>
  <!-- 1. CDN 방식으로 연결하기 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
  <form name="글쓰기" method="post" action="./php/dbinput.php" onsubmit="return formCheck();">
    <section>
      <h2 class="text-center">게시판 글 입력</h2>

      <table class="table table-striped">
        <caption>글입력하기</caption>
        <thead>
          <tr>
            <td scope="row"><label for="subject">제목</label></td>
            <td scope="row"><input type="text" name="subject" id="subject" maxlength="255" autofocus class="form-control"></td>
            <!-- 스크립트 안할 경우 'required' 넣어줄 것 -->
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><label for="name">작성자</label></td>
            <td><input type="text" name="name" id="name" maxlength="50" class="form-control"></td>
          </tr>
          <tr>
            <td><label for="memo">내용</label></td>
            <td><textarea name="memo" id="memo" cols="50" rows="20" class="form-control"></textarea></td>
          </tr>
          <tr>
            <td><label for="pwd">비밀번호</label></td>
            <td><input type="password" name="pwd" id="pwd" maxlength="255" autoComplete="off" class="form-control"></td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="text-center">
            <td colspan="2">
            <a href="./list.php" class="btn btn-light">글 목록</a>
            </td>
          </tr>
          <tr class="text-center">
            <td colspan="2">
            <input type="submit" value="입력 완료" class="btn btn-success">
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
      if(name.value.trim() == ''){
        alert('작성자명을 입력해주세요.');
        name.focus();
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