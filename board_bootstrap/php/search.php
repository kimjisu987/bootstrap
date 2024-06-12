<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>자유게시판 - 검색 목록</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

  <!-- 1. CDN 방식으로 연결하기 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- 부트스트랩 아이콘 CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    main{max-width: 1200px; width: 100%; margin: 0 auto; box-sizing: border-box;}
    section{width: 95%; margin: 0 auto;}
    h2{margin-block: 30px;}
    caption{display: none;}
    pre{
      width: 100%;
      white-space: pre-wrap;
      word-wrap: break-word;
      font-family: "Malgun Gothic";
      text-overflow: ellipsis;
      overflow: hidden;
      word-break: break-word;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }
    tbody td:first-of-type{width: 10%; min-width: 100px;}
    .current{background: #0b5ed7; color: #fff;}
    footer{text-align: center; margin-block: 30px;}
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
    <h2 class="text-center">게시판 글 검색 목록</h2>     
    <form name="글 목록" method="post" action="./search.php" onsubmit="return formCheck();">
      <section>
        <table class="table table-hover">
          <caption>게시판 글 검색 목록</caption>
          <thead class="table-dark text-center">
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
              <td><a href="../view.php?id=<?php echo $row['id']?>" title="<?php echo $row['subject']?>">
            <?php echo $row['subject']?></a></td>
              <td><?php echo $row['memo'] ?></td>
              <!-- echo $row['id'] -->
              <!-- echo $row['name'] -->
              <!-- echo substr($row['datetime'],0,10); : 두번째 방법-->
            </tr>
          <?php endfor; ?>
          </tbody>

        </table>
        <div class="text-center input-group mb-3">
          <input type="search" id="search" name="search" placeholder="제목 또는 내용을 입력하세요." class="form-control">
          <input type="submit" value="검색" id="search_btn" class="btn btn-dark">
          <a href="write.php" title="글쓰기" class="btn btn-primary">글쓰기</a>
        </div>
        <p class="text-center">
          <a href="../list.php" title="글 목록" class="btn btn-dark">전체글 목록</a>
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