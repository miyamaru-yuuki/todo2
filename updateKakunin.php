<?php
require_once ('todotable_class.php');
require_once ('function.php');

if(isset($_POST['tid'],$_POST['tname'],$_POST['status'],$_POST['priority'])) {
    $tid = $_POST['tid'];
    $tname = $_POST['tname'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
}

//進捗　データ加工
$statusDisplay = statusDisplay($status);
//優先順位　データ加工
$priorityDisplay = priorityDisplay($priority);
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
                <p>Todoの内容:<?php echo $tname; ?></p>
                <p>進捗:<?php echo $statusDisplay; ?></p>
                <p>優先順位:<?php echo $priorityDisplay; ?></p>
                <input type="hidden" name="tid" value="<?php echo $tid; ?>">
                <input type="hidden" name="tname" value="<?php echo $tname; ?>">
                <input type="hidden" name="status" value="<?php echo $status; ?>">
                <input type="hidden" name="priority" value="<?php echo $priority; ?>">
                <p>この内容で編集してよろしいですか？</p>
                <p><input type="submit" value="OK"></p>
            </form>
        </main>
    </div>
    <footer>
    </footer>
</div>
</body>
