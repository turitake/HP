<!doctype html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <title><%main_name></title>
    <meta name="description" content="<%main_name>のに関する情報です。">

    <!-- jQuery -->
    <script type="text/javascript" src="../source/jquery-1.9.0.min.js"></script>

    <!-- fancyBox メインとCSSファイル群 -->
    <script type="text/javascript" src="../source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="../source/jquery.fancybox.css?v=2.1.5" media="screen" />

    <!--　デフォルトCSS　-->
    <link rel="stylesheet" href="../css/style2.css">

    <script type="text/javascript">
      $(document).ready(function() {
          $('.fancybox').fancybox(); // 初期設定
      });
    </script>

  </head>
  <body>
    <div class="wrapper">
      <div class="main">

        <h1><%main_name></h1>

        <img src="../images/top/<%top_img>" alt="<%main_name>" class="top_img">

        <h2>基本データ</h2>

        <ul class="name">
          <li>日本名：<%sub_name></li>
          <li>科目　：<%kamoku></li>
          <li>学名　：<%gakumei></li>
        </ul>

        <table class="kihon">
          <tr>
            <th>
              <td class="title">生息地</td>
              <td><%seisoku></td>
            </th>
          </tr>
          <tr>
            <th>
              <td class="">大きさ</td>
              <td><%size></td>
            </th>
          </tr>
          <tr>
            <th>
              <td class="title">花の咲く時期</td>
              <td><%jiki>月</td>
            </th>
          </tr>
          <tr>
            <th>
              <td class="title">花の色</td>
              <td><%color>色</td>
            </th>
          </tr>
          <tr>
            <th>
              <td class="title">花びらの枚数・形</td>
              <td><%maisu>枚</td>
            </th>
          </tr>
        </table>

        <div class="setumei">
          <%setumei>
        </div>

        <div class="btn">
          <a href="http://www.ootk.net/shiki/" title='四季の山野草ＴＯＰ'><img src=../images/etc/top2.gif></a>
        </div>
      </div>
    </div>
    
    <div class="side">
        <div class="side_location">
          撮影場所：<%basyo>
        </div>

        <div class="photo">
          <a class="fancybox" href="../images/sub1/<%sub1_img>" target="_blank"><img src="../images/sub1/<%sub1_img>" class="thumb" alt="<%main_name>"></a>
          <a class="fancybox" href="../images/sub2/<%sub2_img>" target="_blank"><img src="../images/sub2/<%sub2_img>" class="thumb" alt="<%main_name>"></a>
        </div>
    </div>
    
  </body>
</html>
