<?php

  $num = $_POST['num'];


  header('Content-Type: application/json; charset=utf-8');

  // $json_string = file_get_contents('php://input');
  // echo $json_string;
  // $obj = json_decode($json_string);

  
  // $num = $_POST['num'];
  echo json_encode($num);
  
