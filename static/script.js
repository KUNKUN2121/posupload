// ドラッグアンドドロップ
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

// ファイルアップロード処理
function file_upload()
{
    console.log("AJAX START")
    let $form = $('form');
    let formData = new FormData($form.get(0));
    
    $.ajax({
        async: true,
        xhr : function(){
            var XHR = $.ajaxSettings.xhr();
            if(XHR.upload){
                XHR.upload.addEventListener('progress',function(e){
                    var percent = parseInt(e.loaded / e.total * 10000) /100;
                    $("#progressBar").text(percent + "%");
                    $('#progress-bar').css("width",percent + "%");
                }, false);
            }
            return XHR;
        },
        url: "http://dev.kun.pink/posupload/model/uploader.php",
        type: "POST",
        data: formData,
        processData: false, // FORM送る
        contentType: false,
        cache: false,
    }).done(function (data,textStatus,jqXHR) {
        console.log("3")
        console.log('SUCCESS');
        // 取得jsonデータ
        var data_stringify = JSON.stringify(data);
        var data_json = JSON.parse(data_stringify);
        console.log(data_json);
        console.log(data_json["link"]);
        var dllink = data_json["link"];

        var currentURL = $(location).attr('href'); // 現在のリンク
        $("#downloadlink").text(currentURL + dllink);
        
        // コピーボタン追加
        $('#target').append('<button id="linkcopy">リンクコピー</button>');


    }).fail(function(jqXHR, textStatus, errorThrown) {
        // 通信失敗時の処理
        alert('ファイルのアプロードに失敗しました。');
        console.log("Error AJAX");
        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
        console.log("errorThrown    : " + errorThrown.message); // 例外情報
        console.log("URL            : " + url);
    });
}


// https://maywork.net/computer/php-upload-drag-and-drop/