<?php
// 保存先のディレクトリ + アップロードしたファイル名
$upload_file_path = "./images/top/" . $_FILES["file_upload_test"]["name"];
// アップロードが有効ならデータディレクトリにコピー
if(move_uploaded_file($_FILES["file_upload_test"]["tmp_name"],$upload_file_path)){
	print("アップロード完了");
} else {
	print("アップロード失敗");
}
?>
