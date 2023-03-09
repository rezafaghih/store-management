<?php 
  $mysql = false;

  $database = [
    'db' => "store",
    'host' =>"localhost",
    "username" => 'root',
    'password' => "",
  ];

  if ($mysql == false){
    $mysql = mysqli_connect($database['host'], $database['username'], $database['password'], $database['db']);
  }
?>