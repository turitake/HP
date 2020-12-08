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

  if (isset($_POST["review"])==true)
  {
    $url = "main_name=$main_name&sub_name=$sub_name&kamoku=$kamoku&syubetu=$syubetu&maisu_img=$maisu_img&gakumei=$gakumei&hiduke=$hiduke&maisu=$maisu&syubetu_img=$syubetu_img&color=$color&color_img=$color_img&basyo=$basyo&setumei=$setumei&sub1_img=$sub1_img&sub2_img=$sub2_img&main_img=$main_img";
    header("location: template_reveiw.php?".$url);
    exit();
  }
/*
  if (isset($_POST["review"])==true)
  {
*/
    //DB接続

    //ファイル採番番号取得SQL実行

    //htmlファイル名作成

    //テンプレートファイル読み込み

    //htmlファイル挿入データ作成

    //htmlファイル作成＆書込み

    //DB登録SQL実行

    //DB切断

?>
