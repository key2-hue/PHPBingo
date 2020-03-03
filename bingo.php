<?php 

namespace MyBingo;

class Bingo {
  public $ajaxNum = [1,2,3,4];
  

  public function num() {
    // $bingoNum = 1;
    // while($bingoNum <= 75) {
    //   array_push($ajaxNum,$bingoNum);
    //   $bingoNum++;
    // }
    // shuffle($ajaxNum);
    // return $ajaxNum;
    // shuffle($ajaxNum);
    // return $ajaxNum;
  }

  public function start() {
    $allNum = [];

    for($i = 0; $i < 5; $i++) {
      $num = range($i * 15 + 1, $i * 15 + 15);
      shuffle($num);
      $allNum[$i] = array_slice($num, 0 , 5);
    }

    $allNum[2][2] = "FREE";
    return $allNum;
  }
  
}

