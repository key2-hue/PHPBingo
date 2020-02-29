<?php
  $number = range(1,75);
  shuffle($number)
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
</body>
</html>