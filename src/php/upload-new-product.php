<?php 

  include_once "./db.php";

  session_start();


  function moveImageToDirectory($image , $max_size, $directory){
    // , $max_size, $format_list, $directory
    $image_name = $image['name'];
    $image_temp = $image['tmp_name'];
    $image_size = $image['size'];    
    if ($image_size > $max_size){
      return 'size';
    }

    $explode = explode(".", $image_name);
    $new_name = uniqid().".".$explode[1];
    $address = $directory.$new_name;
    move_uploaded_file($image_temp, $address);

    return $new_name;
  }

  function uploadNewProduct(){
    global $mysql;

    $product_name = htmlspecialchars($_POST['product-name']);
    $count = htmlspecialchars($_POST['count-of-product']);
    $price = htmlspecialchars($_POST['product-price']);
    $cover = $_FILES['product-cover'];


   if (empty($product_name) or empty ($count) or empty ($price)){
    header("Location: ../../?q=empty");
    exit;
   }

   $cover_output = moveImageToDirectory($cover, 5000000, "../../product/");


   mysqli_query($mysql, "INSERT INTO `product` (`name`, `count`, `price`, `image-address`) VALUES ('$product_name', '$count', '$price', '$cover_output')");


   header("Location: ../../");
   exit;

  }


  if (isset($_POST['submit-product-form'])){
    uploadNewProduct();
    unset($_POST['submit-product-form']);
  }
?>