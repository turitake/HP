<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>四季の花々</title>
    <!--ファビコン-->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png">
    <meta name="description" content="高山植物や身近に咲いている植物を名前・色・花びらの枚数・季節で検索できます。">

    <!--　デフォルトCSS　-->
    <link rel="stylesheet" href="./css/index.css">
    <!--　Font Awesome　-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />

  </head>
  <body>
    <header class="header">
      <!--　トップ　　-->
      <h1 class="logo">
        四季の花々
      </h1>

      <div class="sub_logo">
        見つけた植物の名前を探すのに苦労していませんか？<br>
        中々見ることができない高山植物や身近に咲いている園芸植物まで掲載しています。
      </div>

      <!--　ナビリンク部　-->
      <nav class="global-nav">
        <ul>
          <li class="nav-item"><a href="http://localhost/shiki/index.html">トップ</a></li>
          <li class="nav-item"><a href="#">検索方法</a></li>
          <li class="nav-item"><a href="#">ブログ</a></li>
          <li class="nav-item"><a href="#">お問合せ</a></li>
        </ul>
      </nav>
    </header>

<?php
  /*************パラメータエスケープ*************/
  $kisetu = htmlspecialchars($_GET["season"]);
  $color = htmlspecialchars($_GET["color"]);
  $maisu = htmlspecialchars($_GET["maisu"]);
  $katati = htmlspecialchars($_GET["katati"]);

  /*************名前検索の正規化（全角ひらがな）*************/
  //前後の空白を削除
  $name = htmlspecialchars($_GET["name"]);
  $name = mb_convert_kana($name,"s");
  $name = trim($name);
  //半角カタカタに変換
  $name = mb_convert_kana($name, "k");
  $name = mb_convert_kana($name, "h");
  //濁点、半濁点を削除
  $name = mb_ereg_replace("ﾞ|ﾟ","",$name);
  // 半角カタカナを全角ひらがなに変換する
  $name = mb_convert_kana($name, "H");

  /*************sql作成*************/
  $sql_result = "select no,main_name,top_img,updatedate from plant where 1";
  $sql_count = "select count(*) from plant where 1";

  // //全件検索判定
  // if ($name==""&&$_GET["season"]==""&&$_GET["color"]==""&&$_GET["maisu"]==""&&$_GET["katati"]=="") {
  //   $sql_result = "select no,main_name,top_img,updatedate from plant";
  //   //$sql_result = "select main_name from plant";
  //   $sql_count = "select count(*) from plant";
  // }

  // //WHERE句作成
  // if ($name!=""||$_GET["season"]!=""||$_GET["color"]!=""||$_GET["maisu"]!=""||$_GET["katati"]!="") {
  //   $sql_result = $sql_result ." where";
  //   $sql_count = $sql_count . " where";
  // }

  //名前検索
  if ($name!="") {
    $sql_result = $sql_result ." and search_name like '%" .$name ."%'";
    $sql_count = $sql_count ." and search_name like '%" .$name ."%'";
  }

  //季節
  if ($_GET["season"]!="") {
    $sql_result = $sql_result ." and kisetu = '" .$kisetu ."'";
    $sql_count = $sql_count ." and kisetu = '" .$kisetu ."'";
  } 

  //色
  if ($_GET["color"]!="") {
    $sql_result = $sql_result ." and color = '" .$color ."'";
    $sql_count = $sql_count ." and color = '" .$color ."'";
  }

  //枚数
  //5枚以下
  if ($_GET["maisu"]!=""&&$_GET["maisu"]!="6") {
    $sql_result = $sql_result ." and maisu = '" .$maisu ."'";
    $sql_count = $sql_count ." and maisu = '" .$maisu ."'";
  }

  //6枚以上
  if ($_GET["maisu"]!=""&&$_GET["maisu"]=="6") {
    $sql_result = $sql_result ." and maisu >= '" .$maisu ."'";
    $sql_count = $sql_count ." and maisu >= '" .$maisu ."'";
  }

  //形
  if ($_GET["katati"]!="") {
    $sql_result = $sql_result ." and katati = '" .$katati ."'";
    $sql_count = $sql_count ." and katati = '" .$katati ."'";
  }

  
  /*************検索結果表示*************/
  try {
    //ページングソース読み込み
    include_once("Paging.php");

    //ページ毎の件数を設定
    $row_count = 3;

    //現在のページを取得 存在しない場合は1とする
    $page = 1;
    if(isset($_GET['page']) && is_numeric($_GET['page'])){
        $page = (int)$_GET['page'];
    }
    if(!$page){
        $page = 1;
    }

    //DB接続
    $dsn = "mysql:dbname=flower;host=localhost;charset=utf8";
    $user = "root";
    $password = "";
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //order句作成
    $sql_result = $sql_result ." order by main_name limit " .(($page - 1) * $row_count).", ".$row_count;

    //print($sql_count);
    
    //sql_result実行
    $stmt = $dbh->prepare($sql_result);
    $stmt->execute();
    //$row = $stmt->rowcount();
    $stmt_cnt = $dbh->query($sql_count);

    //検索件数格納
    $count = $stmt_cnt -> fetch(PDO::FETCH_COLUMN);

    //検索詳細格納
    $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Pagingクラスを生成し、ページングのHTMLを生成
    $pageing = new Paging();
    $pageing -> count = $row_count;
    $pageing -> setHtml($count);
?>

  <div class="wrapper">
  <div class="result"><?php echo $count ?>件の検索結果が表示されました。</div>
  
    <div class="main grid">

<?PHP
    foreach($rec as $value) {

      $date = date("Y年m月d日",strtotime($value["updatedate"]));
?>
      <div class="item">
        <a href="http://localhost/shiki/wiki/no_<?= $value["no"]?>.html" target="_blank"class="item_link"><img src="./images/top/<?= $value["top_img"]?>" alt="<?= $value["main_name"]?>" class="photo"><br>
        <div class="link_name"><?= $date ?><br>No.<?= $value["no"]?> <?= $value["main_name"]?></div>
        </a>
      </div>
  
<?PHP
    }
?>
    

<?PHP
    //DB切断
    $dbh = null;

  } catch (\Throwable $th) {
    print ("DB接続エラー<br>");
    //print ($th."<br>");
    //print ($sql_result."<br>");
    //print($sql_count);
    exit();
  }
?>
    </div>
    </div>
    <?php echo $pageing -> html ?>
    <!-- <?php print($sql_result."<br>"); ?>
    <?php print($sql_result."<br>"); ?> -->
  </body>
</html>