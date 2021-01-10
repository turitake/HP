<?php
  //セッションスタート
  session_start();

  //変数宣言・代入
  $no = $_POST["no"];
  $filename = "no_" . $no . ".html";
  $new_filename = "template_no_" . $no . ".php";
  $date = new DateTime();
  $date = $date->modify("+8 hour");
  $date = $date->format("Ymd");
  $_SESSION["no"] = $no;

  //ファイルの存在チェック
  if (file_exists("./details/".$filename)) {
      //echo $filename . "が存在します。";
      //既存ファイルバックアップ
      copy("./details/".$filename,"./backup/".$filename . "_" . $date);

      //既存ファイル読み込み
      $data_all = file("./details/" .$filename);

      //新規テンプレートファイル作成
      $handle = fopen("./update/" . $new_filename, "w");

      for ($i=0; $i < count($data_all)-9; $i++) {
        fwrite( $handle, $data_all[$i]);
      }

      $add_filename = "template_add.php";
      $add_contents =  file_get_contents($add_filename);

      fwrite( $handle, $add_contents);

      fclose( $handle );
  }
  else {
      echo $filename . "は存在しません。";
  }
 ?>


 <!doctype html>
 <html lang="jp">
   <head>
     <meta charset="utf-8">
     <title>詳細ページ作成</title>
     <meta name="description" content="花の名前、植物、図鑑、植物図鑑">
     <!--<link rel="stylesheet" href="./css/style.css">-->
     <link rel="stylesheet" href="./css/create.css">
     <!-- jQuery -->
     <script type="text/javascript" src="./source/jquery-1.9.0.min.js"></script>

     <!-- fancyBox メインとCSSファイル群 -->
     <script type="text/javascript" src="./source/jquery.fancybox.js?v=2.1.5"></script>
     <link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css?v=2.1.5" media="screen" />

     <script type="text/javascript">
       $(document).ready(function() {
           $('.fancybox').fancybox(); // 初期設定
       });
     </script>

   </head>
   <!--<form  action="create.php" method="post" enctype="multipart/form-data">-->
   <form  action="update2.php" method="post" enctype="multipart/form-data">
     <body>
       <div>
         <!--      トップ       -->
         <a href="http://www.ootk.net/shiki/" title='四季の山野草ＴＯＰ'><img src=./images/etc/title_main.gif class="topimg"></a>
       </div>

       <!--　　　花名、別名、学名　　-->
<!--       <table class="aaa">
         <tr>
           <td>
               <span class="sp1">花の名前&nbsp;&nbsp;<input type="text" name="main_name" style="width:300px"></span><br>
               <span class="sp2">ひらがな・漢字&nbsp;&nbsp;<input type="text" name="sub_name" style="width:300px"></span><br>
               <span class="sp2">科目&nbsp;&nbsp;<input type="text" name="kamoku" style="width:300px"></span><br>
               <span class="sp2">種別&nbsp;&nbsp;1:花&nbsp;&nbsp;2:葉&nbsp;&nbsp;3:実<input type="text" name="syubetu" style="width:30px">&nbsp;&nbsp;&nbsp;種別イメージ&nbsp;&nbsp;</span><input type="file" name="syubetu_img" style="width:400px"><br>
               <span class="sp2">学名&nbsp;&nbsp;<input type="text" name="gakumei" style="width:300px"></span><br>
               <span class="sp2">花トップ画像&nbsp;&nbsp;<input type="file" name="top_img" style="width:400px"></span>
           </td>
         </tr>
       </table>
       <br>
 -->
       <table class="bbb">
         <tr>
           <td class="title">
             <!--  撮影日、花びらの枚数、花の色   -->
             <span class="sp3">撮影日（yyyy年mm月dd日）&nbsp;&nbsp;<input type="text" name="hiduke" style="width:120px"></span><br>
             <span class="sp3">花びらの枚数&nbsp;&nbsp;<input type="text" name="maisu" style="width:30px">&nbsp;&nbsp;&nbsp;花びらイメージ&nbsp;&nbsp;</span><input type="file" name="maisu_img" style="width:400px"></span><br>
             <span class="sp3">花の形&nbsp;&nbsp;<input type="text" name="katati" style="width:120px"></span><br>
             <span class="sp3">色&nbsp;&nbsp;<input type="text" name="color" style="width:30px">&nbsp;&nbsp;色イメージ&nbsp;&nbsp;<input type="file" name="color_img" style="width:400px"></span><br>
             <span class="sp3">季節&nbsp;&nbsp;1:春&nbsp;&nbsp;2:夏&nbsp;&nbsp;3:秋&nbsp;&nbsp;4:冬<input type="text" name="kisetu" style="width:30px"></span>
           </td>
           <!--  撮影場所   -->
           <td class="title">撮影場所&nbsp;&nbsp;<input type="text" name="basyo" style="width:300px"></td>
         </tr>
         <tr>
           <!--  花の説明、花の画像１、花の画像２   -->
           <td>
             <div class="setumei">
               花の説明&nbsp;&nbsp;<input type="text" name="setumei" style="width:300px;height:80px;">
             </div>
             <br>
             <div>花左上画像&nbsp;&nbsp;</span><input type="file" name="sub1_img" style="width:400px"></div>
             <div>花左下画像&nbsp;&nbsp;</span><input type="file" name="sub2_img" style="width:400px"></div>
           </td>
           <!--  メイン画像   -->
           <td>
             <div>花メイン画像&nbsp;&nbsp;</span><input type="file" name="main_img" style="width:400px"></a></div>
           </td>
         </tr>
       </table>

       <table>
         <tr>
           <!--<td class="none"> <a href="http://www.ootk.net/shiki/" title='四季の山野草ＴＯＰ'><img src=./images/etc/top2.gif></a>-->
           <td class="none">

             <!--<input type="submit" name="review" value="レビュー">-->
             <input type="submit" name="add" value="作成">
           </td>
         </tr>
       </table>
     </body>
   </form>

 </html>
