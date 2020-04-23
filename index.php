<?php
    require_once ('todotable_class.php');

    $dsn = "mysql:dbname=mmr";
    $username = "mmr";
    $pass = "pass";
    $db = new PDO($dsn,$username,$pass);
    
    $todo = new TodoTable($db);
    $todos = $todo->get_todoAll();
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
        <h1>todo管理</h1>
    </header>
    <div id="contents">
        <main>
            <table>
                <tr><th>Todoの内容</th><th>進捗</th><th>優先順位</th><th>登録時間</th><th>削除</th></tr>
                <?php
                foreach($todos as $todo){
                    ?>
                <tr><td><?php echo htmlspecialchars($todo->getTname()); ?></td><td><?php echo htmlspecialchars($todo->getStatus()); ?></td><td><?php echo htmlspecialchars($todo->getPriority()); ?></td><td><?php echo $todo->getRegistrationTime(); ?></td><td><a href="">削除</a></td></tr>
                <?php
                }
                ?>
            </table>
        </main>
    </div>
    <footer>
    </footer>
</div>
</body>
