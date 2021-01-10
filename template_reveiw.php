<!doctype html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <title><?php echo $_GET["main_name"]; ?></title>
    <meta name="description" content="<?php echo $_GET["main_name"]; ?>のに関する情報です。">

    <!-- jQuery -->
    <script type="text/javascript" src="./source/jquery-1.9.0.min.js"></script>

    <!-- fancyBox メインとCSSファイル群 -->
    <script type="text/javascript" src="./source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css?v=2.1.5" media="screen" />

    <!--　デフォルトCSS　-->
    <link rel="stylesheet" href="./css/style2.css">

    <script type="text/javascript">
      $(document).ready(function() {
          $('.fancybox').fancybox(); // 初期設定
      });
    </script>

  </head>
  <body>
    <div class="wrapper">
      <div class="main">

        <h1><?php echo $_GET["main_name"]; ?></h1>

        <img src="./images/top/<?php echo $_GET["top_img"]; ?>" alt="<?php echo $_GET["main_name"]; ?>" class="top_img">

        <h2>基本データ</h2>

        <ul class="name">
          <li>日本名：<?php echo $_GET["sub_name"]; ?></li>
          <li>科目　：<?php echo $_GET["kamoku"]; ?></li>
          <li>学名　：<?php echo $_GET["gakumei"]; ?></li>
        </ul>

        <table class="kihon">
          <tr>
            <th>
              <td class="title">生息地</td>
              <td><?php echo $_GET["seisoku"]; ?></td>
            </th>
          </tr>
          <tr>
            <th>
              <td class="">大きさ</td>
              <td><?php echo $_GET["size"]; ?></td>
            </th>
          </tr>
          <tr>
            <th>
              <td class="title">花の咲く時期</td>
              <td><?php echo $_GET["jiki"]; ?>月</td>
            </th>
          </tr>
          <tr>
            <th>
              <td class="title">花の色</td>
              <td><?php echo $_GET["color"]; ?>色</td>
            </th>
          </tr>
          <tr>
            <th>
              <td class="title">花びらの枚数・形</td>
              <td><?php echo $_GET["maisu"]; ?>枚</td>
            </th>
          </tr>
        </table>

        <div class="setumei">
          <?php echo $_GET["setumei"]; ?>
        </div>



         <!--<a href="http://www.ootk.net/shiki/" title='四季の山野草ＴＯＰ'><img src=./images/etc/top2.gif></a>-->
         <div style="text-align: right;">
           <input type="button" onclick="history.back()" value="戻る">
         </div>

      </div>
    </div>

    <div class="side">
        <div class="side_location">
          撮影場所：<?php echo $_GET["basyo"]; ?>
        </div>

        <div class="photo">
          <a class="fancybox" href="./images/sub1/<?php echo $_GET["sub1_img"]; ?>" target="_blank"><img src="./images/sub1/<?php echo $_GET["sub1_img"]; ?>" class="thumb" alt="<?php echo $_GET["main_name"]; ?>"></a>
          <a class="fancybox" href="./images/sub2/<?php echo $_GET["sub2_img"]; ?>" target="_blank"><img src="./images/sub2/<?php echo $_GET["sub2_img"]; ?>" class="thumb" alt="<?php echo $_GET["main_name"]; ?>"></a>
        </div>
    </div>
  </body>
</html>
