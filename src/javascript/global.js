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
      id =  findBoxID(index);
      phpAjax(id, "add");
    })
  }

  for (let index = 0; index < less.length; index++) {  
    less[index].addEventListener("click", function(){
      value = parseInt(count_of_product_span[index].innerHTML);
      count_of_product_span[index].innerHTML = value-1;
      value = null;
      id =  findBoxID(index);
      phpAjax(id ,"less");
    })
  }
})

function findBoxID(i){
  if (i != undefined){
    const box = document.querySelectorAll(".box");
    id = box[i].getAttribute('product-id');

    return id;
  }
}


function phpAjax(id, type){
  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if (this.status == 200 && this.readyState == 4){
     return this.responseText;
    }
  }
  xml.open("GET", "src/php/change-count.php?id="+id+"&type="+type, true);
  xml.send();
}