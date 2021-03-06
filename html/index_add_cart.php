<?php
// 定数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
// userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
// itemデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'item.php';
// cartデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'cart.php';

// ログインチェックを行うため、セッションを開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === false){
  // ログインしていない場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

// PDOを取得
$db = get_db_connect();

// PDOを利用してログインユーザのデータを取得
$user = get_login_user($db);

// POSTされた$nameを取得
$item_id = get_post('item_id');

// 関数add_cartの呼び出し
if(add_cart($db,$user['user_id'], $item_id)){
  // 完了メッセージ 　
  set_message('カートに商品を追加しました。');
} else {
// エラーメッセージ
  set_error('カートの更新に失敗しました。');
}

// HOMEへリダイレクト
redirect_to(HOME_URL);