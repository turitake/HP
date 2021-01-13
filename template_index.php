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

    <div class="wrapper">
      <!--　お知らせ　-->
      <ul class="scroll-list">
        <li class="scroll-item">
          <a href="#">
            <time class="date" datetime="2015-08-23">2015.08.23</time>
            <span class="category news">NEWS</span>
            <span class="title">WORKSを更新しました。</span>
          </a>
        </li>
        <li class="scroll-item">
          <a href="#">
            <time class="date" datetime="2015-08-12">2015.08.12</time>
            <span class="category">TOPIC</span>
            <span class="title">CSSでここまでできる！？ホントに使えるCSSセレクタ10選！</span>
          </a>
        </li>
        <li class="scroll-item">
          <a href="#">
            <time class="date" datetime="2015-08-04">2015.08.04</time>
            <span class="category news">NEWS</span>
            <span class="title">TOPICSを更新しました。</span>
          </a>
        </li>
        <li class="scroll-item">
          <a href="#">
            <time class="date" datetime="2015-07-25">2015.07.25</time>
            <span class="category">TOPIC</span>
            <span class="title">HTML/CSSコーディングと切っても切れないWebブラウザのシェア動向をチェックしよう</span>
          </a>
        </li>
        <li class="scroll-item">
          <a href="#">
            <time class="date" datetime="2015-07-09">2015.07.09</time>
            <span class="category">TOPIC</span>
            <span class="title">HTML5の新しい属性で手軽にフォームバリデーション</span>
          </a>
        </li>
        <li class="scroll-item">
          <a href="#">
            <time class="date" datetime="2015-06-30">2015.06.30</time>
            <span class="category news">NEWS</span>
            <span class="title">WORKSを更新しました。</span>
          </a>
        </li>
      </ul>
    <div>

      <div class="search">
        <form action="search.php" class="search_form" method="post">
          <!--名前検索-->
          <span class="sp1">名前検索</span><input type="text" name="name" class="search_name">
          <!--季節-->
          <span class="sp2">季節</span>
          <select name="season">
            <option value="">全て</option>
            <option value="春">春</option>
            <option value="夏">夏</option>
            <option value="秋">秋</option>
            <option value="冬">冬</option>
          </select>
          <!--色-->
          <span class="sp2">色</span>
          <select name="color">
            <option value="">全て</option>
            <option value="紫" style="background-color:rgb(206, 77, 238);">紫色系</option>
            <option value="青" style="background-color:rgb(35, 82, 235);">青色系</option>
            <option value="赤" style="background-color:red;">赤色系</option>
            <option value="桃" style="background-color:pink;">桃色系</option>
            <option value="白" style="background-color:white;">白色系</option>
            <option value="黄" style="background-color:yellow;">黄色系</option>
            <option value="緑" style="background-color:greenyellow;">緑色系</option>
            <option value="茶" style="background-color:brown;">茶色系</option>
            <option value="黒" style="background-color:black; color: white;">黒色系</option>
          </select>
          <!--花の枚数-->
          <span class="sp2">花びらの枚数</span>
          <select name="number">
            <option value="">全て</option>
            <option value="1">1枚</option>
            <option value="2">2枚</option>
            <option value="3">3枚</option>
            <option value="4">4枚</option>
            <option value="5">5枚</option>
            <option value="6">6枚以上</option>
          </select>
          <!--花の形-->
          <span class="sp2">花びらの形</span>
          <select name="shape">
            <option value="">全て</option>
            <option value="唇">唇型</option>
            <option value="豆">豆型</option>
            <option value="密集">密集花</option>
          </select>          
          
          <span class="sp3"></span>
          <button type="submit" class="btn"><i class ="fa fa-search"></i>検索</button>
        </form>
      </div>

      <!--　写真掲載部　-->
      <div class="main grid">
        <%contents>
      </div>
  </body>
</html>
