<?php
// 変数の初期化
$db = null;
$sql = null;
$res = null;

// データベースと接続
$db = new SQLite3("../static/database.db");

// テーブルの存在確認
$sql = 'SELECT count(*) FROM sqlite_master WHERE type="table" AND name="contents"';

// テーブルが存在しない場合のみテーブル作成
if( !$db->querySingle($sql) ) {

	// テーブルを追加
	$sql = "CREATE TABLE contents(
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		name TEXT NOT NULL,
		md5 TEXT,
		hash TEXT,
		limited NUMERIC,
  		created NUMERIC
	)";
	echo("テーブル作成しました。");
	$res = $db->exec($sql);
}

// データベースの接続解除
$db->close();
?>