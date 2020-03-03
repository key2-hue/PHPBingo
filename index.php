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
  $finalNum = [];
  for($i = 0; $i < 5;$i++) {
    for($s = 0; $s < 5; $s++) {
      $finalNum.array_push($num[$s][$i]);
    }
  }


  $hitNum = $num;
  $hitNum[2][2] = 0;
  $php_json = json_encode($hitNum);
  
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
    <?php $index = 1 ?>
    <?php for ($i = 0; $i < 5; $i++): ?>
      <tr>
        <?php for($a = 0; $a < 5; $a ++): ?>
          <td class="num <?php echo $index?>"><?php echo $num[$a][$i]?></td>
          <?php $index++; ?>
        <?php endfor; ?>
      </tr>
    <?php endfor; ?>
  </table>
  
  
  
  <form action="" method="post" class="lottery">
    <input type="submit" value="次の番号を抽選する" class="lotteryBtn">
    <input type="hidden" value="<?php echo $number[0] ?>" class="sendNum" name="num">
  </form>
  <p class="resultTimes"></p>
  <p class="resultNum"></p>
  <p class="resultScore"></p>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $(function() {
      let i = 0;
      let hitNum = 0;
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
        if(i === 1) {
          
          $('.' + 13).css({'opacity':0.5});
          hitNum ++;
        }
        const bingo2 = JSON.parse('<?php echo $php_json?>');
        let j = 1
        for(var num = 0; num < 5; num++) {
          for(var index = 0; index < 5; index++) {
            if(data == bingo2[index][num]) {
              console.log("hit");
              console.log(data);
              console.log(bingo2[index][num]);
              $('.' + j).css({'opacity':0.5});
              $('.' + j).addClass('done');
              hitNum++;
            }
            j++;
          }
        }
        
        if($('.1').hasClass('done') && 
           $('.6').hasClass('done') &&
           $('.11').hasClass('done') &&
           $('.16').hasClass('done') &&
           $('.21').hasClass('done')
        ) {
          console.log('Bingo');
        }

        if($('.2').hasClass('done') && 
           $('.7').hasClass('done') &&
           $('.12').hasClass('done') &&
           $('.17').hasClass('done') &&
           $('.22').hasClass('done')
        ) {
          console.log('Bingo');
        }

        if($('.3').hasClass('done') && 
           $('.8').hasClass('done') &&
           $('.13').hasClass('done') &&
           $('.18').hasClass('done') &&
           $('.23').hasClass('done')
        ) {
          console.log('Bingo');
        }
      
         
        
        
        if(i < 76) {
          $('.resultTimes').text(i + "回目の抽選です");
          $('.resultNum').text("出た数字は " + data);
        } else {
          $('.resultTimes').empty();
          $('.resultNum').empty();
          $('.lotteryBtn').prop('disabled',true);
          $('.lotteryBtn').val("抽選終了です！");
        }
        
        $('.resultScore').text("空いている数" + hitNum + "マス");
      }).fail(function(msg){
        alert(msg);
      });
    });
    })
  </script>
</body>
</html>