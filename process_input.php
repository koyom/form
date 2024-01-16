<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$name = $_POST['name'];
$email = $_POST['email'];
$rating = $_POST['rating'];

$file = fopen("responses.txt", "a");

if ($file === false) {
    die("Error: Unable to open file.");
}

fwrite($file, "名前: $name, Email: $email, 本の評価: $rating\n");
fclose($file);

header("Location: thank_you.html");
exit;
?>
