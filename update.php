<?php
require_once ('todotable_class.php');
$return = require ('env.php');

if(isset($_GET['tid'])){
    $tid = $_GET['tid'];
}

$dsn = "mysql:dbname=mmr";
$username = "mmr";
$pass = "pass";
$db = new PDO($dsn,$username,$pass);
$todo = new TodoTable($db);

$todoSingle = $todo->get_todo($tid);

//進捗　データ加工
if($todoSingle->getStatus() == $return['key']['unfinished']){
    $statusDisplay = $return['status'][0];
}elseif($todoSingle->getStatus() == $return['key']['finished']){
    $statusDisplay = $return['status'][1];
}

//優先順位　データ加工
if($todoSingle->getPriority() == $return['key2']['high']){
    $priorityDisplay = $return['priority'][0];
}elseif($todoSingle->getPriority() == $return['key2']['medium']){
    $priorityDisplay = $return['priority'][1];
}elseif($todoSingle->getPriority() == $return['key2']['row']){
    $priorityDisplay = $return['priority'][2];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
    <title>todo管理</title>
    <style>
    </style>
    <link rel="stylesheet" type="text/css" href="styles.css?ver=3">
</head>
<body>
<div id="wrapper">
    <header>
        <h1>編集画面</h1>
    </header>
    <div id="contents">
        <main>
            <form method="POST" action="updateKakunin.php">
                <p>Todoの内容 <input type="text" name="tname" value="<?php echo $todoSingle->getTname(); ?>"></p>
                <p>進捗 <input type="text" name="tname" value="<?php echo $statusDisplay; ?>"></p>
                <p>優先順位 <input type="text" name="tname" value="<?php echo $priorityDisplay; ?>"></p>
                <p><input type="submit" value="編集"></p>
            </form>
        </main>
    </div>
    <footer>
    </footer>
</div>
</body>
