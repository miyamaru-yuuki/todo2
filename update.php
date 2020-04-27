<?php
require_once ('todotable_class.php');
require_once ('function.php');
$env = require ('env.php');

if(isset($_GET['tid'])){
    $tid = $_GET['tid'];
}

$db = db();
$todo = new TodoTable($db);

$todoSingle = $todo->get_todo($tid);
$priority = $todoSingle->getPriority($env);
$status = $todoSingle->getStatus($env);
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
                        foreach($env['status'] as $key => $value){
                            if($key == $status){
                                echo '<option value="' .$key. '" selected>' .$value. '</option>';
                            }else{
                                echo '<option value="' .$key. '">' .$value. '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div>優先順位
                    <select name="priority">
                        <?php
                        foreach($env['priority'] as $key => $value){
                            if($key == $priority){
                                echo '<option value="' .$key. '" selected>' .$value. '</option>';
                            }else{
                                echo '<option value="' .$key. '">' .$value. '</option>';
                            }
                        }
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
