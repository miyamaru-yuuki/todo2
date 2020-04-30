<?php
require_once ('function.php');
require_once ('todo_class.php');

if(!isset($_POST['tid'],$_POST['tname'],$_POST['status'],$_POST['priority'])) {
    header("Location: http://mmr.e5.valueserver.jp/todo2/index.php?error=1");
    exit();
}

$tid = $_POST['tid'];
$tname = $_POST['tname'];
$status = $_POST['status'];
$priority = $_POST['priority'];

$karahantei = str_replace(array(" ", "　"), "", $tname);

if(empty($karahantei)){
    header("Location: http://mmr.e5.valueserver.jp/todo2/update.php?error=2&tid=" .$tid);
    exit();
}

$todo = new Todo($tid,$tname,$status,$priority,null);
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
        <h1>編集確認画面</h1>
    </header>
    <div id="contents">
        <main>
            <form method="POST" action="index.php">
                <p>Todoの内容:<?php echo $todo->getTname(); ?></p>
                <p>進捗:<?php echo $todo->getStatusDisplay(); ?></p>
                <p>優先順位:<?php echo $todo->getPriorityDisplay(); ?></p>
                <input type="hidden" name="tid" value="<?php echo $todo->getTid(); ?>">
                <input type="hidden" name="tname" value="<?php echo $todo->getTname(); ?>">
                <input type="hidden" name="status" value="<?php echo $todo->getStatus(); ?>">
                <input type="hidden" name="priority" value="<?php echo $todo->getPriority(); ?>">
                <p>この内容で編集してよろしいですか？</p>
                <p><input type="submit" value="OK"></p>
            </form>
        </main>
    </div>
    <footer>
    </footer>
</div>
</body>
