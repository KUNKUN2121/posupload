<?php
$hash = $_GET['hash'];

// $db = new SQLite3("static/database.db");
// $stmt = $db->prepare('SELECT * FROM contents WHERE hash = :hash');
// $stmt->bindValue( ':hash', $hash, SQLITE3_TEXT);

// $res = $stmt->execute();
// $resp = $res->fetchArray();
// $hash = $resp["hash"];
    // $userData = array();
    // // var_dump($res->fetchArray());

    // while($row = $res->fetchArray()){
    //     // print($row["name"] . ", " . $row["hash"] . "\n");
    //     $row["hash"];
    //     // echo('<a href="files/">aa</a>');
    // }


    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $dir = glob('files/' . $hash . '/*.*');
        if($dir==false){
            // 存在しない
            echo '存在しません。';
            return;
        }
    ?>
    <p> 以下からダウンロードする</p> 
    <?php
        foreach ($dir as $key => $value) {
            $file = basename($value);
            echo('<a href="'. $value . '">'. $file .'</a>');
            // echo $value . '<br>';
        }
    ?>
</body>
</html>