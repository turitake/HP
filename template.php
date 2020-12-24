<!doctype html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <title>花の名前(<%sub_name>)</title>
    <meta name="description" content="花の名前、植物、図鑑、植物図鑑">
    <link rel="stylesheet" href="../css/style.css">

    <!-- jQuery -->
    <script type="text/javascript" src="../source/jquery-1.9.0.min.js"></script>

    <!-- fancyBox メインとCSSファイル群 -->
    <script type="text/javascript" src="../source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="../source/jquery.fancybox.css?v=2.1.5" media="screen" />

    <script type="text/javascript">
      $(document).ready(function() {
          $('.fancybox').fancybox(); // 初期設定
      });
    </script>

  </head>
  <body>
    <div>
      <!--      トップ       -->
      <a href="http://www.ootk.net/shiki/" title='四季の山野草ＴＯＰ'><img src=../images/etc/title_main.gif class="topimg"></a>
    </div>

    <!--　　　花名、別名、学名　　-->
    <table class="aaa">
      <tr>
        <td>
            <span class="sp1"><%main_name></span><br>
            <span class="sp2"><%sub_name></span>
            <span class="sp2"><%kamoku></span>
            <span class="sp2"><img src=../images/etc/<%syubetu_img>></span>
            <span class="sp2">学名：<%gakumei></span><br>
            <span class="sp4">別名・別読み：<%betumei></span>
        </td>
      </tr>
    </table>
    <br>

    <table class="bbb">
      <tr>
        <td class="title">
          <!--  撮影日、花びらの枚数、花の色   -->
          <span class="sp3"><%hiduke></span>
          <span class="sp3"><img src=../images/etc/<%maisu_img>></span>
          <span class="sp3"><img src=../images/etc/<%color_img>></span>
        </td>
        <!--  撮影場所   -->
        <td class="title"><%basyo></td>
      </tr>
      <tr>
        <!--  花の説明、花の画像１、花の画像２   -->
        <td>
          <div class="setumei">
          <%setumei>
          </div>
          <br>
          <div><a class="fancybox" href="../images/sub1/<%sub1_img>" target="_blank"><img src="../images/sub1/<%sub1_img>" class="thumb"></a></div>
          <div><a class="fancybox" href="../images/sub2/<%sub2_img>" target="_blank"><img src="../images/sub2/<%sub2_img>" class="thumb"></a></div>
        </td>
        <!--  メイン画像   -->
        <td>
          <div ><a class="fancybox" href="../images/main/<%main_img>" target="_blank"><img src="../images/main/<%main_img>" class="mainphoto"></a></div>
        </td>
      </tr>
    </table>

    <table>
      <tr>
        <td class="none"> <a href="http://www.ootk.net/shiki/" title='四季の山野草ＴＯＰ'><img src=../images/etc/top2.gif></a>
        </td>
      </tr>
    </table>

  </body>
</html>
