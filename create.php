<?php
  //変数宣言・代入
  $main_name = $_POST{"main_name"};
  $sub_name = $_POST["sub_name"];
  $kamoku = $_POST["kamoku"];
  $syubetu = $_POST["syubetu"];
  $syubetu_img = $_FILES["syubetu_img"]["name"];
  $gakumei = $_POST["gakumei"];
  $hiduke = $_POST["hiduke"];
  $maisu = $_POST["maisu"];
  $maisu_img = $_FILES["maisu_img"]["name"];
  $color = $_POST["color"];
  $color_img = $_FILES["color_img"]["name"];
  $basyo = $_POST["basyo"];
  $setumei = $_POST["setumei"];
  $sub1_img = $_FILES["sub1_img"]["name"];
  $sub2_img = $_FILES["sub2_img"]["name"];
  $main_img = $_FILES["main_img"]["name"];
  $top_img = $_FILES["top_img"]["name"];
  $katati = $_POST["katati"];
  $kisetu = $_POST["kisetu"];

  if (isset($_POST["review"])==true)
  {
    $url = "main_name=$main_name&sub_name=$sub_name&kamoku=$kamoku&syubetu=$syubetu&maisu_img=$maisu_img&gakumei=$gakumei&hiduke=$hiduke&maisu=$maisu&syubetu_img=$syubetu_img&color=$color&color_img=$color_img&basyo=$basyo&setumei=$setumei&sub1_img=$sub1_img&sub2_img=$sub2_img&main_img=$main_img";
    header("location: template_reveiw.php?".$url);
    exit();
  }

  if (isset($_POST["add"])==true)
  {
    try {
      //DB接続
      $dsn = "mysql:dbname=flower;host=localhost;charset=utf8";
      $user = "root";
      $password = "";
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      //ファイル採番番号取得SQL実行
      $sql = "select no from plant order by no desc limit 1";
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      //htmlファイル名作成
      $fileno = $rec["no"] + 1;
      $filename = "no_" . $fileno . ".html";

      //テンプレートファイル読み込み
      $template = "template.php";
      $contents = file_get_contents( $template);

      //htmlファイル挿入データ作成
      $contents = str_replace( "<%main_name>", htmlspecialchars($main_name), $contents);
      $contents = str_replace( "<%sub_name>", htmlspecialchars($sub_name), $contents);
      $contents = str_replace( "<%kamoku>", htmlspecialchars($kamoku), $contents);
      $contents = str_replace( "<%syubetu_img>", htmlspecialchars($syubetu_img), $contents);
      $contents = str_replace( "<%gakumei>", htmlspecialchars($gakumei), $contents);
      $contents = str_replace( "<%hiduke>", htmlspecialchars($hiduke), $contents);
      $contents = str_replace( "<%maisu_img>", htmlspecialchars($maisu_img), $contents);
      $contents = str_replace( "<%color_img>", htmlspecialchars($color_img), $contents);
      $contents = str_replace( "<%setumei>", htmlspecialchars($setumei), $contents);
      $contents = str_replace( "<%sub1_img>", htmlspecialchars($sub1_img), $contents);
      $contents = str_replace( "<%sub2_img>", htmlspecialchars($sub2_img), $contents);
      $contents = str_replace( "<%main_img>", htmlspecialchars($main_img), $contents);

      //htmlファイル作成＆書込み
      $handle = fopen( $filename, 'w');
      //fwrite( $handle, "test");
      fwrite( $handle, $contents);
      fclose( $handle );

      //詳細ファイル移動
      rename($filename,"details/" . $filename);

      //挿入日付取得
      $date = new DateTime();
      $date = $date->modify("+8 hour");
      $date = $date->format("Y-m-d H:i:s");
      //$date = date("Y-m-d",$date);

      //DB登録SQL実行
      $sql2 = "INSERT INTO plant (main_name,sub_name,gakumei,kamoku,syubetu,kisetu,color,maisu,katati,top_img,insertdate) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
      $stmt2 = $dbh->prepare($sql2);
      $data[] = $main_name;
      $data[] = $sub_name;
      $data[] = $gakumei;
      $data[] = $kamoku;
      $data[] = $syubetu;
      $data[] = $kisetu;
      $data[] = $color;
      $data[] = $maisu;
      $data[] = $katati;
      $data[] = $top_img;
      $data[] = $date;
      $stmt2->execute($data);

      //DB切断
      $dbh = null;

      // メッセージ表示
    	print $filename. "を生成し、書き込みを行いました。";

    } catch (\Exception $e) {
      print "DB接続エラー";
      exit();
    }


  }
?>
