// モーダルトリガーボタンを取得
var modalTriggers = document.querySelectorAll('.open-modal');

// モーダルウィンドウを取得
var modal = document.getElementById('modal');

// 閉じるボタンを取得
var closeBtn = document.getElementsByClassName('close')[0];

// モーダルトリガーボタンがクリックされた時の処理
modalTriggers.forEach(function(trigger) {
    trigger.onclick = function(event) {
        event.preventDefault(); // デフォルトのアクションを無効にする
        showModal(); // モーダルを表示
    }
});

// モーダルウィンドウを表示する関数
function showModal() {
    modal.style.display = 'block'; // モーダルを表示
}

// 閉じるボタンがクリックされた時の処理
closeBtn.onclick = function () {
    hideModal();
    //modal.style.display = "none";
    //window.location.href = "http://localhost/";
    //var baseUrl = window.location.href.split("?")[0];
    // クエリパラメータを取り除く
    //window.location.href = baseUrl;
    //container.removeClass('active');
}

// モーダルの外側（背景）がクリックされた時の処理
window.onclick = function(event) {
    if (event.target === modal) {
        hideModal(); // モーダルを非表示
    }
}

//モーダルウィンドウを非表示にする関数
function hideModal() {
    modal.style.display = 'none'; // モーダルを非表示
    //heartIcon.style.display = 'block'; // ハートアイコンを表示
}