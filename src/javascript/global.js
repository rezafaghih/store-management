window.addEventListener("load", function(){
  var hidde_container = this.document.querySelector(".hidden-container");
  if (hidde_container != undefined){
    var button = this.document.querySelector("#upload-new-product");
    var visible = false;
    var close_button = this.document.querySelector("#close_button");
    button.addEventListener("click", function(){
      if (visible == false){
        hidde_container.style.display = "flex";
        visible = true;
      }
    })

    close_button.addEventListener("click", function(){
      if (visible){
        hidde_container.style.display = "none";
        visible = false;
      }
    })
  }

  var add = this.document.querySelectorAll("#more-count");
  var less = this.document.querySelectorAll("#less-count");

  var count_of_product_span = this.document.querySelectorAll("#count-of-product");


  for (let index = 0; index < add.length; index++) {
    add[index].addEventListener("click", function(){
      value = parseInt(count_of_product_span[index].innerHTML);
      count_of_product_span[index].innerHTML = value+1;
      value = null;
    })
  }

  for (let index = 0; index < less.length; index++) {  
    less[index].addEventListener("click", function(){
      value = parseInt(count_of_product_span[index].innerHTML);
      count_of_product_span[index].innerHTML = value-1;
      value = null;
    })
  }
})
