<?php
    try {
      //DB接続
      $dsn = "mysql:dbname=flower;host=localhost;charset=utf8";
      $user = "root";
      $password = "";
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      //ファイル採番番号取得SQL実行
      $sql = "select no,main_name,top_img,updatedate from plant ORDER BY updatedate DESC LIMIT 16";
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

    } catch (\Exception $e) {
      print "DB接続エラー";
      exit();
    }

    //バッファリング有効化
    ob_start();
?>

      <!--　写真掲載部　-->
      <div class="main grid">
<?php
      while($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $date = date("Y年m月d日",strtotime($rec["updatedate"]));
?>
        <div class="item">
          <a href="http://localhost/shiki/wiki/no_<?= $rec["no"]?>.html" target="_blank"class="item_link"><img src="./images/top/<?= $rec["top_img"]?>" alt="<?= $rec["main_name"]?>" class="photo"><br>
          <div class="link_name"><?= $date ?><br>No.<?= $rec["no"]?> <?= $rec["main_name"]?></div>
          </a>
        </div>
<?php
      }

      //DB切断
      $dbh = null;
?>

<?php
      file_put_contents("index_result.html",ob_get_contents());

      ob_end_clean();

      print("index_result.htmlを作成しました。");
?>
      
