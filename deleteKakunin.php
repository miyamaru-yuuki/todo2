<?php
require_once ('function.php');
require_once ('todotable_class.php');

if(!isset($_GET['tid'])){
    header("Location: http://mmr.e5.valueserver.jp/todo2/index.php?error=1");
}

$tid = $_GET['tid'];
$todo = new TodoTable(db());
$todoSingle = $todo->get_todo($tid);

$status = $todoSingle->getStatus();
$priority = $todoSingle->getPriority();

//進捗　データ加工
$statusDisplay = statusDisplay($status);
//優先順位　データ加工
$priorityDisplay = priorityDisplay($priority);
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
                <p>Todoの内容:<?php echo $todoSingle->getTname(); ?></p>
                <p>進捗:<?php echo $statusDisplay; ?></p>
                <p>優先順位:<?php echo $priorityDisplay; ?></p>
                <p>登録時間:<?php echo $todoSingle->getRegistrationTime(); ?></p>
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
