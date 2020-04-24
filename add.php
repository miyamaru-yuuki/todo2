<?php
if(isset($_POST['tname'],$_POST['priority'])){
    $tname = $_POST['tname'];
    $priority = $_POST['priority'];
    //優先順位　データ加工
    $return = require ('env.php');
    if($priority == $return['key2']['high']){
        $priorityDisplay = $return['priority'][0];
    }elseif($priority == $return['key2']['medium']){
        $priorityDisplay = $return['priority'][1];
    }elseif($priority == $return['key2']['row']){
        $priorityDisplay = $return['priority'][2];
    }
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
        <h1>追加確認画面</h1>
    </header>
    <div id="contents">
        <main>
            <form method="POST" action="index.php">
                <p>Todoの内容:<?php echo $tname; ?></p>
                <p>優先順位:<?php echo $priorityDisplay; ?></p>
                <input type="hidden" name="tname" value="<?php echo $tname; ?>">
                <input type="hidden" name="priority" value="<?php echo $priority; ?>">
                <p><input type="submit" value="OK"></p>
            </form>
        </main>
    </div>
    <footer>
    </footer>
</div>
</body>
