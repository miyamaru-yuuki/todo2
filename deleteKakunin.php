<?php
require_once ('function.php');
require_once ('todotable_class.php');

if(!isset($_GET['tid'])){
    header("Location: http://mmr.e5.valueserver.jp/todo2/index.php?error=1");
    exit();
}

$tid = $_GET['tid'];
$todoTable = new TodoTable(db());
$singleData = $todoTable->get_todo($tid);

if(is_null($singleData->getTid())){
    header("Location: http://mmr.e5.valueserver.jp/todo2/index.php?error=3");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
    <title><?php echo title(); ?></title>
    <style>
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo css(); ?>?ver=3">
</head>
<body>
<div id="wrapper">
    <header>
        <h1>削除確認画面</h1>
    </header>
    <div id="contents">
        <main>
            <form method="POST" action="index.php">
                <p>Todoの内容:<?php echo $singleData->getTname(); ?></p>
                <p>進捗:<?php echo $singleData->getStatusDisplay(); ?></p>
                <p>優先順位:<?php echo $singleData->getPriorityDisplay(); ?></p>
                <p>登録時間:<?php echo $singleData->getRegistrationTime(); ?></p>
                <input type="hidden" name="tid" value="<?php echo $tid; ?>">
                <p>このデータを削除してよろしいですか？</p>
                <p><input type="submit" value="OK"></p>
            </form>
        </main>
    </div>
    <footer>
    </footer>
</div>
</body>
