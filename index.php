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
    // echo $number[0];
    unset($number[0]);
  };
  unset($_SESSION['random']);

  $game = new \MyBingo\Bingo();
  $num = $game->start();
  $number = range(1,75);
  shuffle($number);
  $js = $number[0];
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
  
  
  
  <form action="" method="post" class="lottery">
    <input type="submit" value="次の番号を抽選する">
    <input type="hidden" value="<?php echo $number[0] ?>" class="sendNum" name="num">
  </form>
  <p class="resultTimes"></p>
  <p class="resultNum"></p>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $(function() {
      let i = 0;
      $('.lottery').on('submit', e => {
      i ++;
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
        const bingo = "<?php echo $num ?>";
        for(var num = 0; num < 5; num++){
          for(var index = 0; index < 5; index++) {
            console.log(bingo[index][num]);
          }
        }

         
        
        
        if(i < 76) {
          $('.resultTimes').text(i + "回目の抽選です");
        } else {
          $('.resultTimes').text("抽選終了です");
        }
        $('.resultNum').text("出た数字は " + data)
      }).fail(function(msg){
        alert(msg);
      });
    });
    })
  </script>
</body>
</html>