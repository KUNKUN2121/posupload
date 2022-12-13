<?php
$db = new SQLite3("static/database.db");
$result = $db->query("SELECT * FROM contents");
// 配列を初期化
$ary = array();
while ($rows = $result->fetchArray()) {
    array_push($ary, $rows);
}
echo json_encode($ary, JSON_UNESCAPED_UNICODE);
//jsonとして出力
header('Content-Type: application/json');
$db->close();
?>