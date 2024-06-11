<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>자유게시판 - 글 목록</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

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
    include('./php/dbconn.php');
  ?>
  <!-- 상단 헤더 -->
  <header></header>

  <!-- 메인 콘텐츠 -->
  <main>
    <h2 class="text-center">게시판 글 목록</h2>
    <form name="글 목록" method="post" action="./php/search.php" onsubmit="return formCheck();">
      <section>
        <table class="table table-hover">
          <caption>게시판 글 목록</caption>
          <thead class="table-dark text-center">
            <tr>
              <th>작성일</th><th>제목</th><th>내용</th>
              <!-- <th>No.</th><th>작성자</th> -->
            <tr>
          </thead>

        <tbody>
        <?php
          $num_result = mysqli_query($conn, "SELECT COUNT(*) AS total_rows FROM free_board");
          $num_row = mysqli_fetch_assoc($num_result);
          $num = $num_row['total_rows'];

          $list_num = 5;
          $page_num = 3;
          $page = isset($_GET["page"])? $_GET["page"] : 1;
          
          $total_page = ceil($num / $list_num);
          $total_block = ceil($total_page / $page_num);
          $now_block = ceil($page / $page_num);
          $s_pageNum = ($now_block - 1) * $page_num + 1;
          if($s_pageNum <= 0){$s_pageNum = 1;};
          $e_pageNum = $now_block * $page_num;
          if($e_pageNum > $total_page){$e_pageNum = $total_page;};

          $start = ($page - 1) * $list_num;
          $cnt = $start + 1;

          $sql = "select * from free_board order by id DESC limit $start, $list_num;";
          $result = mysqli_query($conn, $sql);

          // $query = 'select * from free_board order by id DESC';
          // $result = mysqli_query($conn, $query);
          while($row = mysqli_fetch_array($result)){
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
          <?php
              $cnt++;
            };
          ?>
          </tbody>
        </table>

        <!-- 페이지네이션이 들어가는 곳 -->
        <nav aria-label="페이지 내비게이션">
          <ul class="pagination justify-content-center">
          <!-- 이전페이지 출력 -->
          <?php if($page <= 1){ ?>
            <li class="page-item"><a href="list.php?page=1" title="이전 페이지로" class="page-link disabled"><i class="fa-solid fa-chevron-left"></i></a></li>
            <?php }
            else{ ?>
            <li class="page-item"><a href="list.php?page=<?php echo ($page-1); ?>" class="page-link"><i class="fa-solid fa-chevron-left"></i></a></li>
            <?php }; ?>

            <!-- 여기서부터 페이지 번호 출력 -->
            <?php
              for($print_page=$s_pageNum; $print_page <= $e_pageNum; $print_page++){
            ?>
            <li class="page-item"><a <?php if($print_page == $page) echo 'class="current page-link"'; ?> href="list.php?page=<?php echo $print_page; ?>" class="page-link">
              <?php echo $print_page ?>
            </a></li>
            <?php }; ?>

            <!-- 다음페이지 출력 -->
            <?php if($page >= $total_page){ ?>
            <li class="page-item"><a href="list.php?page=<?php echo $total_page ?>" title="다음 페이지로" class="page-link disabled"><i class="fa-solid fa-chevron-right"></i></a></li>
            <?php } else{ ?>
            <li class="page-item"><a href="list.php?page=<?php echo ($page+1); ?>" title="다음 페이지로" class="page-link"><i class="fa-solid fa-chevron-right"></i></a></li>
            <?php }; ?>
          </ul>
        </nav>
          

        <div class="text-center input-group">

          <input type="search" id="search" name="search" placeholder="제목 또는 내용을 입력하세요." class="form-control">

          <input type="submit" value="검색" id="search_btn" class="btn btn-dark">

          <a href="write.php" title="글쓰기" class="btn btn-primary">글쓰기</a>

        </div>
      </section>
    </form>
  </main>

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

<?php include("./php/footer.php"); ?>