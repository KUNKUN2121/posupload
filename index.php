<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="static/style.css">
    <title>Document</title>
</head>
<body>
<script src="static/script.js"></script>
    <div class="main">
        <div id="upload-area" onclick="$('#upload-form-fileselect').click()">ドロップしてください<br /></div>
        <div class="form">
            <form enctype="multipart/form-data" action="" method="post" id="my_form">
                <input type="file" name="file1" multiple="multiple" id="file1">
                <br>
                <select name="limit" id = "limit">
                    <option value = "7">7日</option>
                    <option value = "31">31日</option>
                    <option value = "eternity">無制限</option>
                </select>
                <button type="button" onclick="file_upload()">アップロード2</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php

    // var_dump($_SERVER);
?>