<?php
// フォームから送信されたデータを受け取る
$name = $_POST['name'];
$email = $_POST['email'];
$rating = $_POST['rating'];

// データをファイルに保存する（アペンドモードで追記）
$file = fopen("responses.txt", "a");
fwrite($file, "名前: $name, Email: $email, 本の評価: $rating\n");
fclose($file);

// データの保存が完了したら、サンクスページにリダイレクトする
header("Location: thank_you.html");
exit;
?>
