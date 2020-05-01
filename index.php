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
$sorttname = 0;
$sortstatus = 0;
$sortpriority = 0;
$sortRegistrationTime = 0;

if(isset($_GET['sorttname'])){
    if($_GET['sorttname'] == 0){
        $sorttname = 1;
    }else{
        $sorttname = 0;
    }
}
if(isset($_GET['sortstatus'])){
    if($_GET['sortstatus'] == 0){
        $sortstatus = 1;
    }else{
        $sortstatus = 0;
    }
}
if(isset($_GET['sortpriority'])){
    if($_GET['sortpriority'] == 0){
        $sortpriority = 1;
    }else{
        $sortpriority = 0;
    }
}
if(isset($_GET['sortRegistrationTime'])){
    if($_GET['sortRegistrationTime'] == 0){
        $sortRegistrationTime = 1;
    }else{
        $sortRegistrationTime = 0;
    }
}
$todos = $todoTable->get_todoAll($sorttname,$sortstatus,$sortpriority,$sortRegistrationTime);
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
                <tr><th>Todoの内容</th><th>進捗</th><th>優先順位</th><th><a href="index.php?sorttname=<?php echo $sorttname; ?>&&sortstatus=<?php echo $sortstatus; ?>&&sortpriority=<?php echo $sortpriority; ?>&&sortRegistrationTime=<?php echo $sortRegistrationTime; ?>">登録時間</a></th><th>削除</th></tr>
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
