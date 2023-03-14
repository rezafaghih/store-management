<?php 

  $type = htmlspecialchars($_GET['type']);
  $id = htmlspecialchars($_GET['id']);

  include_once "./db.php";

  function changeCount(){
    global $mysql, $id, $type;
    if ($mysql){
      $id = mysqli_real_escape_string($mysql, $id);
      $query = mysqli_query($mysql , "SELECT * FROM `product` WHERE `id` = '$id'");
      
      if (canFindProduct() == true){
        $row = mysqli_fetch_assoc($query);
        
        if ($type == "add"){
          $newCount= $row['count']+1;
        }else if ($type == "less"){
          $newCount = $row['count']-1;
        }
        mysqli_query($mysql , "UPDATE `product` SET `count` = '$newCount' WHERE `id` = '$id'");
      }
    }
  }
  function canFindProduct(){
    global $mysql, $id;
    if ($mysql){
      $id = mysqli_real_escape_string($mysql, $id);
      $query = mysqli_query($mysql, "SELECT * FROM `product` WHERE `id` = '$id'");
      if (mysqli_num_rows($query) > 0){
        return true;
      }else{
        return false;
      }
    }
  }


  if ($type == "add" and canFindProduct() == true or $type == "less" and canFindProduct() == true){
    changeCount();
  }