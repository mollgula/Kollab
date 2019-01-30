$(document).ready(function () {
    $("input").keypress(function (e) {
        /*エンターキーがおされた時に処理を開始する*/
        if (e.which == 13) {
            //検索処理を記入↓

            /*↓キーボードを閉じる処理*/
            $("input").blur();
        }
    });

});

