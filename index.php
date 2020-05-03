<?php
require_once ('function.php');
require_once ('todotable_class.php');

//エラー処理
if(isset($_GET['error']) && $_GET['error'] == 1){
    echo 'ページを表示できません。トップページから入りなおしてください。';
}elseif(isset($_GET['error']) && $_GET['error'] == 2){
    echo '未入力の項目があります。';
}elseif(isset($_GET['error']) && $_GET['error'] == 3){
    echo '指定したデータは存在しません。';
}

$env = getStatusPriority();
$todoTable = new TodoTable(db());
    
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

//ソート
$item = "registrationtime";
$sort = 0; //ASC

if(isset($_GET['item'],$_GET['sort'])){
    $item = $_GET['item'];
    if($_GET['sort'] == 1){
        $sort = 0;
    }else{
        $sort = 1;
    }
}

$todos = $todoTable->get_todoAll($item,$sort);
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
                <tr><th><a href="index.php?item=tname&sort=<?php echo $sort; ?>">Todoの内容</a></th><th><a href="index.php?item=status&sort=<?php echo $sort; ?>">進捗</a></th><th><a href="index.php?item=priority&sort=<?php echo $sort; ?>">優先順位</a></th><th><a href="index.php?item=registrationtime&sort=<?php echo $sort; ?>">登録時間</a></th><th>削除</th></tr>
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
                            getSelectBox($env['priority'],$priority);
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
