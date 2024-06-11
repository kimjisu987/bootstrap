<!-- view.php -->

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>자유게시판 - 글 내용 보기</title>
  <!-- 1. CDN 방식으로 연결하기 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- 부트스트랩 아이콘 CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    main{max-width: 1200px; width: 100%; margin: 0 auto; box-sizing: border-box;}
    section{width: 95%; margin: 0 auto;}
    h2{margin-block: 30px;}
    caption{display: none;}
    table tr td:first-of-type{width: 20%; box-sizing: border-box;}
    table tr td:last-of-type{width: 80%; box-sizing: border-box;}
    pre{
      width: 100%; box-sizing: border-box;
      white-space: pre-wrap;
      word-wrap: break-word;
      font-family: "Malgun Gothic";
      text-overflow: ellipsis;
      overflow: hidden;
      word-break: break-word;
    }
    div.mb-3{margin-bottom: 0px !important;}
    div.mb-3.row{justify-content: center;}
    .col-form-label{text-align: center;}

    table tr:nth-of-type(7) td{border: 0px;}
    footer{text-align: center; margin-block: 30px;}
  </style>
</head>
<body>
  <?php
    include("./php/dbconn.php");

    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conn, $id);

    // echo $id;   // 넘겨받은 id값 출력
    $sql = "select * from free_board where id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
  ?>

  <h2 class="text-center">글내용 보기</h2>
  <form name="글내용보기" method="post" action="./php/delete.php" id="postForm" onsubmit="return formCheck();">
    <input type="hidden" name="id" value="<?php echo $row['id']?>">
    <main>
      <section>
        <table class="table">
          <caption>글내용 보기</caption>
          <tr>
            <td>No.</td>
            <td><?php echo $row['id'] ?></td>
          </tr>
          <tr>
            <td>작성자</td>
            <td><?php echo $row['name'] ?></td>
          </tr>
          <tr>
            <td>제목</td>
            <td><?php echo $row['subject'] ?></td>
          </tr>
          <tr>
            <td>내용</td>
            <td><?php echo $row['memo'] ?></td>
          </tr>
          <tr>
            <td>작성일</td>
            <td><?php echo substr($row['datetime'],0,10) ?></td>
          </tr>
          <tr>
            <td colspan="2" class="text-center">
              <a href="./list.php" title="글 목록" class="list btn btn-light">글 목록</a>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="mb-3 row">
                <label for="pwd" class="col-sm-2 col-form-label">비밀번호</label>
                <div class="col-sm-3">
                  <input type="password" class="form-control" id="pwd"name="pwd" autoComplete="off">
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="text-center">
              <input type="submit" id="btn01" name="view_btn" value="수정" class="btn btn-secondary"></input>
              <input type="submit" id="btn02" name="view_btn" value="삭제" class="btn btn-danger"></input>
            </td>
          </tr>
        </table>
      </section>
    </main>
  </form>

  <!-- 유효성검사 -->
  <script>
    function formCheck(){
      if(document.getElementById('pwd').value.trim() == ''){
        alert('비밀번호를 입력해주세요.');
        document.getElementById('pwd').focus();
        return false;
      }
      return true;
    };
  </script>

<?php include("./php/footer.php"); ?>