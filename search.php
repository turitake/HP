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
          <li class="nav-item"><a href="#">トップ</a></li>
          <li class="nav-item"><a href="#">検索方法</a></li>
          <li class="nav-item"><a href="#">ブログ</a></li>
          <li class="nav-item"><a href="#">お問合せ</a></li>
        </ul>
      </nav>
    </header>

<?php
  /*************名前検索の正規化（全角ひらがな）*************/
  //前後の空白を削除
  $name = htmlspecialchars($_POST["name"]);
  $name = mb_convert_kana($name,"s");
  $name = trim($name);
  //半角カタカタに変換
  $name = mb_convert_kana($name, "k");
  $name = mb_convert_kana($name, "h");
  //濁点、半濁点を削除
  $name = mb_ereg_replace("ﾞ|ﾟ","",$name);
  // 半角カタカナを全角ひらがなに変換する
  $name = mb_convert_kana($name, "H");

  /*************SQL作成*************/
  $sql = "select no,main_name,top_img,updatedate from plant";

  //全件検索判定
  if ($name==""&&$_POST["season"]==""&&$_POST["color"]==""&&$_POST["maisu"]==""&&$_POST["katati"]=="") {
    $sql = "select no,main_name,top_img,updatedate from plant";
  }

  //WHERE句作成
  if ($name!=""||$_POST["season"]!=""||$_POST["color"]!=""||$_POST["maisu"]!=""||$_POST["katati"]!="") {
    $sql = $sql ." where";
  }

  //名前検索
  if ($name!="") {
    $sql = $sql ." search_name like '%" .$name ."%'";
  }

  //季節
  if ($name==""&&$_POST["season"]!="") {
    $sql = $sql ." kisetu = '" .$_POST["season"] ."'";
  } elseif ($name!=""&&$_POST["season"]!="") {
    $sql = $sql ." and kisetu = '" .$_POST["season"] ."'";
  }

  //色
  if ($name==""&&$_POST["season"]==""&&$_POST["color"]!="") {
    $sql = $sql ." color = '" .$_POST["color"] ."'";
  } elseif (($name!=""||$_POST["season"]!="")&&$_POST["color"]!="") {
    $sql = $sql ." and color = '" .$_POST["color"] ."'";
  }

  //枚数
  //5枚以下
  if ($name==""&&$_POST["season"]==""&&$_POST["color"]==""&&$_POST["maisu"]!=""&&$_POST["maisu"]!="6") {
    $sql = $sql ." maisu = '" .$_POST["maisu"] ."'";
  } elseif (($name!=""||$_POST["season"]!=""||$_POST["color"]!="")&&$_POST["maisu"]!=""&&$_POST["maisu"]!="6") {
    $sql = $sql ." and maisu = '" .$_POST["maisu"] ."'";
  }

  //6枚以上
  if ($name==""&&$_POST["season"]==""&&$_POST["color"]==""&&$_POST["maisu"]!=""&&$_POST["maisu"]=="6") {
    $sql = $sql ." maisu >= '" .$_POST["maisu"] ."'";
  } elseif (($name!=""||$_POST["season"]!=""||$_POST["color"]!="")&&$_POST["maisu"]!=""&&$_POST["maisu"]=="6") {
    $sql = $sql ." and maisu >= '" .$_POST["maisu"] ."'";
  }

  //形
  if ($name==""&&$_POST["season"]==""&&$_POST["color"]==""&&$_POST["maisu"]==""&&$_POST["katati"]!="") {
    $sql = $sql ." katati = '" .$_POST["katati"] ."'";
  } elseif (($name!=""||$_POST["season"]!=""||$_POST["color"]!=""||$_POST["maisu"]!="")&&$_POST["katati"]!="") {
    $sql = $sql ." and katati = '" .$_POST["katati"] ."'";
  }

  //order句作成
  $sql = $sql ." order by main_name";

  /*************DB接続*************/
  try {
    //DB接続
    $dsn = "mysql:dbname=flower;host=localhost;charset=utf8";
    $user = "root";
    $password = "";
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //SQL実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    

  } catch (\Throwable $th) {
    print "DB接続エラー";
    exit();
  }
  print($sql);
?>
  </body>
</html>