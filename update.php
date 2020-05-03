<?php
require_once ('function.php');
require_once ('todotable_class.php');

if(!isset($_GET['tid'])){
    header("Location: http://mmr.e5.valueserver.jp/todo2/index.php?error=1");
    exit();
}

//エラー処理
if(isset($_GET['error']) && $_GET['error'] == 2){
    echo '未入力の項目があります。';
}

$tid = $_GET['tid'];
$env = getStatusPriority();
$todoTable = new TodoTable(db());
$todoSingle = $todoTable->get_todo($tid);

if(is_null($todoSingle->getTid())){
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
        <h1>編集画面</h1>
    </header>
    <div id="contents">
        <main>
            <form method="POST" action="updateKakunin.php">
                <p>Todoの内容 <input type="text" name="tname" value="<?php echo $todoSingle->getTname(); ?>"></p>
                <div>進捗
                    <select name="status">
                        <?php
                            getSelectBox($env['status'],$todoSingle->getStatus());
                        ?>
                    </select>
                </div>
                <div>優先順位
                    <select name="priority">
                        <?php
                            getSelectBox($env['priority'],$todoSingle->getPriority());
                        ?>
                    </select>
                </div>
                <input type="hidden" name="tid" value="<?php echo $tid; ?>">
                <p><input type="submit" value="編集"></p>
            </form>
        </main>
    </div>
    <footer>
    </footer>
</div>
</body>
