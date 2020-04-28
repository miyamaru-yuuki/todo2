<?php
require_once ('function.php');
require_once ('todotable_class.php');

$env = getEnv();

$db = db();
$todoTable = new TodoTable($db);
    
//追加処理
if(isset($_POST['tid'],$_POST['tname'],$_POST['status'],$_POST['priority'])) {
    $tid = $_POST['tid'];
    $tname = $_POST['tname'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $todo = new Todo($tid,$tname,$status,$priority,null);
    $todoTable->update($todo);
}elseif(isset($_POST['tname'],$_POST['priority'])){
    $tname = $_POST['tname'];
    $priority = $_POST['priority'];
    $todoTable->add($tname,$priority);
}elseif(isset($_POST['tid'])){
    //削除処理
    $tid = $_POST['tid'];
    $todoTable->delete($tid);
}

$todos = $todoTable->get_todoAll();
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
        <h1>todo管理</h1>
    </header>
    <div id="contents">
        <main>
            <table>
                <tr><th>Todoの内容</th><th>進捗</th><th>優先順位</th><th>登録時間</th><th>削除</th></tr>
                <?php
                foreach($todos as $todo){
                    ?>
                    <tr><td><a href="update.php?tid=<?php echo $todo->getTid(); ?>"><?php echo h($todo->getTname()); ?></a></td><td><?php echo h($todo->getStatusDisplay()); ?></td><td><?php echo h($todo->getPriorityDisplay()); ?></td><td><?php echo $todo->getRegistrationTime(); ?></td><td><a href="deleteKakunin.php?tid=<?php echo $todo->getTid(); ?>">削除</a></td></tr>
                <?php
                }
                ?>
            </table>
            <p>Todoを追加する</p>
            <form method="POST" action="add.php">
                <p>Todoの内容 <input type="text" name="tname"></p>
                <p>優先順位 
                    <select name="priority">
                        <?php
                        foreach($env['priority'] as $key => $value){
                        ?>
                        <option value=<?php echo $key; ?> selected><?php echo $value; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </p>
                <p><input type="submit" value="追加"></p>
            </form>
        </main>
    </div>
    <footer>
    </footer>
</div>
</body>
