window.addEventListener("load", function(){
  var hidde_container = this.document.querySelector(".hidden-container");
  if (hidde_container != undefined){
    var button = this.document.querySelector("#upload-new-product");
    var visible = false;

    button.addEventListener("click", function(){
      if (visible == false){
        hidde_container.style.display = "flex";
      }
    })
  }
})
