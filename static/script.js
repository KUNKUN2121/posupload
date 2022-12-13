$(document).ready(function () {

    $("#upload-area").on("dragenter", function(e){
        $("#upload-area").css("background", "#EEE");
    });
    $("#upload-area").on("dragleave", function(e){
        $("#upload-area").css("background", "#DDD");
    });
    
    $("#upload-area").on("drop", function(e){
        document.getElementById("file1").files = e.originalEvent.dataTransfer.files;
        // テキスト変更
        document.getElementById("upload-area").innerText = document.getElementById("file1").files[0].name;
        $("#upload-area").css("background", "#EFE");
        file_upload()
    });

    // 
    $(document).on("dragover", function(e){
        e.preventDefault();
    });
    $(document).on("drop", function(e){
        e.preventDefault();
    });

});


function file_upload()
{
    console.log("hello")
    // フォームデータを取得
    // let $upfile = $('input[name="file1"]');
    // var formData = new FormData();
    // formData.append("file1", $upfile.prop('files')[0]);
    let $form = $('form');
    let formData = new FormData($form.get(0));

    $.ajax({
        url: "http://dev.kun.pink/posupload/model/uploader.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
    }).done(function (data) {
        //取得jsonデータ
        var data_stringify = JSON.stringify(data);
        var data_json = JSON.parse(data_stringify);
        // 成功時の処理
        console.log( 'SUCCESS', data );

    }).fail(function() {
        // console.log( 'ERROR', jqXHR, textStatus, errorThrown );
       // 失敗時の処理
    });


}

// https://maywork.net/computer/php-upload-drag-and-drop/