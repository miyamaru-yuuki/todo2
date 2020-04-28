<?php
/*
関数名：db
機能：データベースに接続する
引数：なし
戻り値：データベース接続のインスタンス
*/
function db(){

    $db = new PDO("mysql:dbname=mmr","mmr","pass");

    return $db;
}

/*
 関数名：h
 機能：文字列をエスケープして返す　XSS対策
 引数：出力する文字列
 戻り値：エスケープした文字列
 */
function h($s){

    return htmlspecialchars($s,ENT_QUOTES,"UTF-8");
}

/*
 関数名：title
 機能：サイトタイトルを取得する
 引数：なし
 戻り値：サイトタイトル
 */
function title(){
    return 'todo管理';
}

/*
 関数名：css
 機能：読み込むCSSファイルを取得する
 引数：なし
 戻り値：CSSファイル
 */
function css(){
    return 'styles.css';
}

/*
関数名：statusDisplay
機能：ステータス番号を対応する文字列に変換する
引数：ステータス番号
戻り値：ステータスの文字列
*/
function statusDisplay($status)
{
    $env = getEnv();
    $statusDisplay = $env['status'][$status];
    return $statusDisplay;
}

/*
関数名：priorityDisplay
機能：優先順位番号を対応する文字列に変換する
引数：優先順位番号
戻り値：優先順位の文字列
*/
function priorityDisplay($priority)
{
    $env = getEnv();
    $priorityDisplay = $env['priority'][$priority];
    return $priorityDisplay;
}

/*
関数名：getEnv
機能：ステータスと優先順位の設定情報を読み込む
引数：なし
戻り値：ステータスと優先順位の設定情報
*/
function getEnv()
{
    return [
        'status'=>['未了','完了'],
        'priority'=>['高','中','低']
    ];
}