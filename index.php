<?php

  require_once(__DIR__ . '/bingo.php');
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

  $game = new \MyBingo\Bingo();
  $num = $game->start();
  $number = range(1,75);
  shuffle($number);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ビンゴゲーム</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <table>
    <tr class="title"> 
      <th>B</th><th>I</th><th>N</th><th>G</th><th>O</th>
    </tr>
    <?php for ($i = 0; $i < 5; $i++): ?>
      <tr>
        <?php for($a = 0; $a < 5; $a ++): ?>
          <td class="num"><?php echo $num[$a][$i]?></td>
        <?php endfor; ?>
      </tr>
    <?php endfor; ?>
  </table>
  <p class="resultNum"></p>
  
  <?php var_dump($number) ?>
  <form action="" method="post" class="lottery">
    <input type="submit" value="次の番号を抽選する">
    <input type="hidden" value="<?php echo $number[0] ?>" class="sendNum">
  </form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $('.lottery').on('submit', e => {
      e.preventDefault();
      $.ajax({
        url: 'lottery.php',
        type: 'POST',
        dataType: 'json', 
        data: {
          num: $('.sendNum').val(),
        },
        processData: false,
        contentType: false,
      }).done(function(data) {
        $('.resultNum').text(data);
        console.log(data);
      }).fail(function(msg){
        alert(msg);
      });
    });
  </script>
</body>
</html>