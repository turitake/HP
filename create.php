<?php
  //変数宣言・代入
  $main_name = $_POST["main_name"];
  $sub_name = $_POST["sub_name"];
  $kamoku = $_POST["kamoku"];
  $syubetu = $_POST["syubetu"];
  $gakumei = $_POST["gakumei"];
  $maisu = $_POST["maisu"];
  $color = $_POST["color"];
  $basyo = $_POST["basyo"];
  $setumei = $_POST["setumei"];
  $sub1_img = $_FILES["sub1_img"]["name"];
  $sub2_img = $_FILES["sub2_img"]["name"];
  $top_img = $_FILES["top_img"]["name"];
  $kisetu = $_POST["kisetu"];
  $jiki = $_POST["jiki"];
  $size = $_POST["size"];
  $seisoku = $_POST["seisoku"];
  $katati = $_POST["katati"];

  //画像イメージパス定義
  $top_path = "./images/top/" . $top_img;
  $sub1_path = "./images/sub1/" . $sub1_img;
  $sub2_path = "./images/sub2/" . $sub2_img;


  if (isset($_POST["review"])==true)
  {
    $url = "main_name=$main_name&sub_name=$sub_name&kamoku=$kamoku&syubetu=$syubetu&gakumei=$gakumei&&maisu=$maisu&color=$color&basyo=$basyo&setumei=$setumei&sub1_img=$sub1_img&sub2_img=$sub2_img&top_img=$top_img&jiki=$jiki&size=$size&seisoku=$seisoku";
    header("location: template_reveiw.php?".$url);

    //画像データアップロード
    if (move_uploaded_file($_FILES["top_img"]["tmp_name"],$top_path)) {
      print("TOP画像アップロード完了<br>");
    } else {
      print("TOP画像アップロード失敗<br>");
    }

    if (move_uploaded_file($_FILES["sub1_img"]["tmp_name"],$sub1_path)) {
      print("sub1画像アップロード完了<br>");
    } else {
      print("sub1画像アップロード失敗<br>");
    }

    if (move_uploaded_file($_FILES["sub2_img"]["tmp_name"],$sub2_path)) {
      print("sub2画像アップロード完了<br>");
    } else {
      print("sub2画像アップロード失敗<br>");
    }

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
      //$fileno = 1;
      $filename = "no_" . $fileno . ".html";

      //画像データアップロード
      if (move_uploaded_file($_FILES["top_img"]["tmp_name"],$top_path)) {
        print("TOP画像アップロード完了<br>");
      } else {
        print("TOP画像アップロード失敗<br>");
      }

      if (move_uploaded_file($_FILES["sub1_img"]["tmp_name"],$sub1_path)) {
        print("sub1画像アップロード完了<br>");
      } else {
        print("sub1画像アップロード失敗<br>");
      }

      if (move_uploaded_file($_FILES["sub2_img"]["tmp_name"],$sub2_path)) {
        print("sub2画像アップロード完了<br>");
      } else {
        print("sub2画像アップロード失敗<br>");
      }

      //テンプレートファイル読み込み
      $template = "template.php";
      $contents = file_get_contents( $template);

      //htmlファイル挿入データ作成
      $contents = str_replace( "<%main_name>", htmlspecialchars($main_name), $contents);
      $contents = str_replace( "<%sub_name>", htmlspecialchars($sub_name), $contents);
      $contents = str_replace( "<%kamoku>", htmlspecialchars($kamoku), $contents);
      $contents = str_replace( "<%gakumei>", htmlspecialchars($gakumei), $contents);
      $contents = str_replace( "<%color>", htmlspecialchars($color), $contents);
      $contents = str_replace( "<%setumei>", htmlspecialchars($setumei), $contents);
      $contents = str_replace( "<%basyo>", htmlspecialchars($basyo), $contents);
      $contents = str_replace( "<%sub1_img>", htmlspecialchars($sub1_img), $contents);
      $contents = str_replace( "<%sub2_img>", htmlspecialchars($sub2_img), $contents);
      $contents = str_replace( "<%top_img>", htmlspecialchars($top_img), $contents);
      $contents = str_replace( "<%jiki>", htmlspecialchars($jiki), $contents);
      $contents = str_replace( "<%seisoku>", htmlspecialchars($seisoku), $contents);
      $contents = str_replace( "<%size>", htmlspecialchars($size), $contents);
      $contents = str_replace( "<%maisu>", htmlspecialchars($maisu), $contents);

      //htmlファイル作成＆書込み
      $handle = fopen( $filename, 'w');
      //fwrite( $handle, "test");
      fwrite( $handle, $contents);
      fclose( $handle );

      //詳細ファイル移動
      rename($filename,"wiki/" . $filename);

      //挿入日付取得
      $date = new DateTime();
      $date = $date->modify("+8 hour");
      $date = $date->format("Y-m-d H:i:s");
      //$date = date("Y-m-d",$date);

      /*************検索文字作成*************/
      //半角カタカナに変換
      $hankakuKatakana = mb_convert_kana($main_name, "k");
      //濁点、半濁点を削除
      $hankakuKatakana = mb_ereg_replace("ﾞ|ﾟ","",$hankakuKatakana);
      // 半角カタカナを全角ひらがなに変換する
      $zenkakuHiragana = mb_convert_kana($hankakuKatakana, "H");

      //テーブル[plant]登録SQL実行
      $sql2 = "INSERT INTO plant (main_name,sub_name,search_name,gakumei,kamoku,syubetu,kisetu,color,katati,maisu,top_img,insertdate,updatedate) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $stmt2 = $dbh->prepare($sql2);
      $data[] = $main_name;
      $data[] = $sub_name;
      $data[] = $zenkakuHiragana;
      $data[] = $gakumei;
      $data[] = $kamoku;
      $data[] = $syubetu;
      $data[] = $kisetu;
      $data[] = $color;
      $data[] = $katati;
      $data[] = $maisu;
      $data[] = $top_img;
      $data[] = $date;
      $data[] = $date;
      $stmt2->execute($data);

      //テーブル[place]登録SQL実行
      $sql3 = "INSERT INTO place(no,basyo) VALUES (?,?)";
      $stmt3 = $dbh->prepare($sql3);
      $prm[] = $fileno;
      $prm[] = $basyo;
      $stmt3->execute($prm);

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
<br>
 <button onclick="location.href='http://localhost/shiki/create.html'">続けて作成</button>
 <button onclick="location.href='http://localhost/shiki/create_index.php'">index作成</button>
