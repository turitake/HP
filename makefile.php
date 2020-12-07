<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
  <?php
  $template = "template_test.php";	// ※1 テンプレートファイル名
  $pagetitle = "私のページ";	// ※2 ページのタイトル

  if ($_POST{"honbun"}) {
  	$honbun = $_POST{"honbun"};

  	// タグを除去する場合はコメントアウトを外す
  	// $honbun = htmlspecialchars($honbun);

  	// 文字コードをEUCに変換
  	//$honbun = mb_convert_encoding($honbun, "EUC-JP","AUTO");

  	// ※3 改行を<br>タグに変換
  	$honbun = nl2br($honbun);

  	// クオーテーションマークを変換
  	if(get_magic_quotes_gpc()) { $honbun = stripslashes($honbun); }

  	// 乱数を生成してファイル名に
  	$filename = rand( 1000000, 9999999) . ".html";

  	// ※4 テンプレートファイルの読み込み
  	$contents = file_get_contents( $template);

  	// ※5 タイトルと記事本文を挿入
  	$contents = str_replace( "<%PAGETITLE>", htmlspecialchars($pagetitle), $contents);
  	$contents = str_replace( "<%PAGECONTENTS>", $honbun, $contents);

  	// ファイル生成＆書き込み
  	$handle = fopen( $filename, 'w');
  	fwrite( $handle, $contents);
  	fclose( $handle );

  	// メッセージ表示
  	echo $filename. "を生成し、書き込みを行いました。";
  } else {
  	echo "フォームから記事の内容を送信してください。";
  }
  ?>
</body>
</html>
