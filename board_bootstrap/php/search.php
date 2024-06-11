<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>자유게시판 - 검색 목록</title>
  <style>
    *{margin: 0; padding: 0;}
    body{font-size: 14px;}
    main{max-width: 1200px; margin: 0 auto;}
    section h2{text-align: center; margin-block: 30px;}
    table{
      max-width: 1200px;
      margin: 0 auto; padding: 3%;
      line-height: 200%;
      border-collapse: collapse;
    }
    table a{text-decoration: none; color: #000; font-weight: 600;}
    table tr{
      border-bottom: 1px solid #ddd;
    }
    table caption, table thead{display: none;}
    /* table{display: flex; flex-wrap: wrap;} */
    table tbody{border-top: 1px solid #000;}
    table tbody tr:hover *{color: #215499;}
    table tbody tr td:nth-of-type(1){width: 20%; float: left; margin-top: 30px; padding-left: 10px; box-sizing: border-box;}
    table tbody tr td:nth-of-type(2){width: 80%; float: right; margin-top: 30px; padding-right: 10px; box-sizing: border-box;}
    table tbody tr td:nth-of-type(3){
      width: 80%;
      float: right;
      margin-bottom: 30px; padding-right: 10px;
      box-sizing: border-box;
      color: #666; font-size: 13px;
      line-height: 160%;
      text-overflow: ellipsis;
      overflow: hidden;
      word-break: break-word;
        
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }

    .w_btn, .s_btn{text-align: center; margin-block: 30px;}
    .w_btn a, .s_btn input[type="submit"]{
      display: inline-block;
      text-decoration: none;
      width: 190px; height: 40px;
      padding: 10px 15px;
      border: none;
      background: #215499;
      color: #fff;
      cursor: pointer;
      text-align: center;
      box-sizing: border-box;
      font-weight: normal;
    }
    .w_btn a:last-of-type{background: #333; margin-left: 10px;}
    .s_btn input[type="submit"]{background: #333;}
    .s_btn input[type="search"]{
      width: 250px; height: 34px;
      box-sizing: border-box;
      border-width: 1px;
      background: #fff;
      outline-color: #215499;
      padding-inline: 15px;
      margin-inline: 10px;
    }
    pre{
      width: 100%;
      white-space: pre-wrap;
      word-wrap: break-word;
      font-family: "Malgun Gothic";
    }
    footer{text-align: center; margin-block: 100px 30px;}
  </style>
</head>
<body>
  <?php
    include('./dbconn.php');
  ?>
  <!-- 상단 헤더 -->
  <header></header>

  <!-- 메인 콘텐츠 -->
  <main>
  <form name="글 목록" method="post" action="./search.php" onsubmit="return formCheck();">
    <section>
      <section>
        <h2>게시판 글 검색 목록</h2>        
        <table>
          <caption>게시판 글 검색 목록</caption>
          <thead>
            <tr>
              <th>작성일</th><th>제목</th><th>내용</th>
            <tr>
          </thead>

        <tbody>
        <?php
          $search = $_POST['search'];
          $query = "select * from free_board where subject like '%$search%' or memo like '%$search%' order by id DESC;";
          $result = mysqli_query($conn, $query);
          for($i=0;$row=mysqli_fetch_assoc($result);$i++):
        ?>
            <tr>
              <td><?php echo date("Y-m-d", strtotime($row['datetime']))?></td>
              <td><a href="view.php?id=<?php echo $row['id']?>" title="<?php echo $row['subject']?>">
            <?php echo $row['subject']?></a></td>
              <td><?php echo $row['memo'] ?></td>
              <!-- echo $row['id'] -->
              <!-- echo $row['name'] -->
              <!-- echo substr($row['datetime'],0,10); : 두번째 방법-->
            </tr>
          <?php endfor; ?>
          </tbody>

        </table>
        <p class="s_btn">
          <input type="search" id="search" name="search" placeholder="제목 또는 내용을 입력하세요.">
          <input type="submit" value="검색" id="search_btn">
        </p>
        <p class="w_btn">
          <a href="../write.php" title="글쓰기">글쓰기</a>
          <a href="../list.php" title="글 목록" class="list">전체글 목록</a>
        </p>
      </section>
    </form>
  </main>

  <!-- 하단 푸터 -->
  <footer></footer>

<!-- 유효성검사 -->
<script>
  function formCheck(){
    let search = document.getElementById('search');
    if(search.value.trim() == ''){
      alert('검색하실 내용을 입력해주세요.');
      search.focus();
      return false;
    }
    return true;
  };
</script>


<?php include("footer.php"); ?>