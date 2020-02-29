<?php

  require_once(__DIR__ . '/Bingo.php');
  session_start();
  $number = '';
  if(!isset($_SESSION['random'])) {
    // $_SESSION['random']= 'Done';
    $number = range(1,75);
  }
  shuffle($number);
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $number[0];
    unset($number[0]);
  };
  unset($_SESSION['random']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ビンゴゲーム</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <p><?php echo $number[0] ?></p>
  <?php unset($number[0]) ?>
  <?php var_dump($number) ?>
  <form action="" method="post">
    <input type="submit" value="次の番号を抽選する">
  </form>
</body>
</html>