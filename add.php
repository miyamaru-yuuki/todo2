<?php
require_once ('function.php');
require_once ('todo_class.php');

if(!isset($_POST['tname'],$_POST['priority'])){
    header("Location: http://mmr.e5.valueserver.jp/todo2/index.php?error=1");
    exit();
}

$tname = $_POST['tname'];
$priority = $_POST['priority'];
$todo = new Todo(null,$tname,null,$priority,null);
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
        <h1>追加確認画面</h1>
    </header>
    <div id="contents">
        <main>
            <form method="POST" action="index.php">
                <p>Todoの内容:<?php echo $todo->getTname(); ?></p>
                <p>優先順位:<?php echo $todo->getPriorityDisplay(); ?></p>
                <input type="hidden" name="tname" value="<?php echo $todo->getTname(); ?>">
                <input type="hidden" name="priority" value="<?php echo $todo->getPriority(); ?>">
                <p><input type="submit" value="OK"></p>
            </form>
        </main>
    </div>
    <footer>
    </footer>
</div>
</body>
