<?php 
  include_once "src/php/db.php";

  function displayProduct(){
    global $mysql;

    if ($mysql){
      $query = mysqli_query($mysql, "SELECT * FROM `product`");

      if (mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
          echo '
          <div class="box flex-col" product-id = "'.$row['id'].'">
            <img src="product/'.$row['image-address'].'" alt="no alt">
            <div class="top-text flex-row center" style="justify-content: end;">
              <span class = "text-sm text-main-color">'.$row['name'].'</span>
            </div>
            <div class="two-text-box flex-row" style="flex-direction: row-reverse;">
              <span class = "text-to-sm text-main-color">قیمت محصول</span>
              <span class = "text-to-sm">'.number_format($row['price']).' تومان</span>
            </div>
            <div class="two-text-box flex-row" style="flex-direction: row-reverse;">
              <span class = "text-to-sm text-main-color">تعداد در انبار</span>
              <span id = "count-of-product" class = "text-to-sm">'.number_format($row['count']).'</span>
            </div>
            <div class="two-text-box flex-row" style="flex-direction: row-reverse; margin-top: 10px;" >
              <svg id = "more-count" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
              <svg id = "less-count" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
              </svg>
                  
         
            </div>
            <div class="two-text-box flex-row" style = "justify-content:end; width: 90%; gap:30px;">
            <svg id = "delete-product" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
          </svg>
          <svg id = "edit-product" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
        </svg>

          
            </div>
          </div>
          ';
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مدیریت انبارداری</title>
  <link rel="stylesheet" href="src/styles/style.css?v=<?php echo time();?>">
  <link rel="stylesheet" href="src/styles/global.css">
</head>
<body>
    <div class="container">
      <button id = "upload-new-product" class = "flex-row center">
        اضافه کردن محصول
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
        </svg>
        
      </button>
      <div class="top-text flex-row center">
        <h1 class = "text-lg">انبارداری فروشگاه آنجل</h1>
      </div>
      <div class="top-text flex-row center">
        <span class = "text-sm">انبارداری فروشگاه آنجل</span>
      </div>

       <div class="real-box-container flex-row flex-wrap center">
          <?php 
            displayProduct();
          ?>
    </div>


    <div class="hidden-container flex-row center" style="display:none;">
    <form action="src/php/upload-new-product.php" method="POST" enctype="multipart/form-data">
    <div class="content-container flex-col center" style="gap:30px; justify-content: start;">
        <div class="top-text flex-row center">
          <h1 class = "text-sm text-main-color">اضافه کردن محصول</h1>
        </div>
        <div class="input-container flex-row center">
          <label for="">
            نام محصول
          </label>
          <input type="text" name="product-name" id="" placeholder="نام محصول را وارد کنید">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
          </svg>
        </div>

        <div class="input-container flex-row center">
          <label for="">
            تعداد محصول در انبار
          </label>
          <input type="text" name="count-of-product" id="" placeholder="تعداد را وارد کنید">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
          </svg>
          
        </div>
        <div class="input-container flex-row center">
          <label for="">
            قیمت محصول
          </label>
          <input type="text" name="product-price" id="" placeholder="قیمت به تومان">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
          </svg> 
        </div>

        <div class="input-container flex-row center">
          <label id = "cover-label" for="upload-product-cover" class = "flex-row center">
            آپلود عکس محصول
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>            
          </label>
          <input type="file" name="product-cover" id="upload-product-cover" hidden>
        </div>
        <button name = "submit-product-form" >اضافه کردن محصول</button>
        <button id = "close_button" type="button">بستن پنل</button>
      </div>
    </form>
      
    </div>
</body>
</html>

<script src="src/javascript/global.js?v=<?php echo time();?>"></script>