<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
  <?php
  	$url ="http://localhost/sample.php";

  	$buff = file_get_contents($url);

  	$fname = "outputtest.html";

  	$fhandle = fopen( $fname, "w");
  	fwrite( $fhandle, $buff);
  	fclose( $fhandle );

  	echo "<a href='".$fname."'>作ったファイルを開く</a>";
  ?>
</body>
</html>
