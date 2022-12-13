<?php
require_once 'database.php';

$return['error'] = false;
$return['link'] = "";
$return['msg'] = "";


//　保存場所設定
$savepath = '../files/';

// ファイル受け取り
$tempfile = $_FILES['file1']['tmp_name']; // 一時ファイル名
$filename = $_FILES['file1']['name']; // 本来のファイル名

// ファイルmd5作成
$md5 = md5_file($tempfile);
$hash = md5(uniqid(rand(), true)); 

// 時刻取得
date_default_timezone_set('Asia/Tokyo');
$nowdate = new DateTime();
$limited = new DateTime();

// 有効期限取得
$limit = $_POST["limit"];
switch ($limit) {
    case 'eternity':
        // $savepath = $savepath.'eternity/';
        break;
    case '7':
        // $savepath = $savepath.'7/';
        $limited->modify('+7 day');
        break;
    case '31':
        // $savepath = $savepath.'31/';
        $limited->modify('+31 day');
        break;
}

// フォルダ作成
$savepath = $savepath . $hash . '/';
mkdir($savepath, 0777);

// Dateフォーマット変換
$nowdate = $nowdate->format('Y-m-d H:i:s');
$limited = $limited->format('Y-m-d H:i:s');

if (is_uploaded_file($tempfile)) {
    if (move_uploaded_file($tempfile , $savepath . $filename )) {
	echo $filename . "をアップロードしました。";
    } else {
        echo "ファイルをアップロードできません。";
    }
} else {
    echo "ファイルが選択されていません。";
} 

$db = new SQLite3("../static/database.db");
$stmt = $db->prepare('INSERT INTO contents (name, hash, md5, limited, created) VALUES (:name, :hash, :md5, :limited, :created)');

$stmt->bindValue( ':name', $filename, SQLITE3_TEXT);
$stmt->bindValue( ':md5', $md5, SQLITE3_TEXT);
$stmt->bindValue( ':hash', $hash, SQLITE3_TEXT);
$stmt->bindValue( ':limited', $limited, SQLITE3_TEXT);
$stmt->bindValue( ':created', $nowdate, SQLITE3_TEXT);

$res = $stmt->execute();
var_dump($res);
$return['link'] = "hash";
echo (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] .  $_SERVER["REQUEST_URI"] . 'download.php?' . 'hash';
$db->close();
?>