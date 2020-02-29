<?php

  header('Content-Type: application/json; charset=utf-8');


  $num = filter_input(INPUT_POST,"num");
  echo json_encode($num);
  return $num;
