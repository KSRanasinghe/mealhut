// qty_inc

function qty_inc() {
  var input = document.getElementById("qty");

  if (input.value < 10) {
    var newValue = parseInt(input.value) + 1;
    input.value = newValue.toString();
  }
}

// qty_inc

// qty_dec

function qty_dec() {
  var input = document.getElementById("qty");

  if (input.value > 1) {
    var newValue = parseInt(input.value) - 1;
    input.value = newValue.toString();
  }
}
// qty_dec

// addToCart

function addToCart(id) {
  var qty = document.getElementById("qty");

  var f = new FormData();
  f.append("mid", id);
  f.append("q", qty.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else if (t == "signin") {
        window.location = "signIn.php";
      } else if (t == "address") {
        window.location = "addresslist.php";
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "addToCartProcess.php", true);
  r.send(f);
}

// addToCart

// dirAddToCart

function dirAddToCart(id){
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else if (t == "signin") {
        window.location = "signIn.php";
      } else if (t == "address") {
        window.location = "addresslist.php";
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  }

  r.open("GET","directAddToCartProcess.php?id="+id,true);
  r.send();
}

// dirAddToCart

// removeCart

function removeCart(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Somthing went wrong!");
      }
    }
  }

  r.open("GET","removeCartProductProcess.php?id="+id,true);
  r.send();
}

// removeCart

// qty_dec_cart

function qty_dec_cart(id) {
  var input = document.getElementById("qty"+id);

  var newValue = 1;
  if (parseInt(input.innerHTML) > 1) {
    newValue = parseInt(input.innerHTML) - 1;
    input.innerHTML = newValue;
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Somthing went wrong!");
      }
    }
  }

  r.open("GET","cartQtyUpdateProcess.php?id="+id+"&q="+newValue,true);
  r.send();
}

// qty_dec_cart

// qty_inc_cart

function qty_inc_cart(id) {
  var input = document.getElementById("qty"+id);

  var newValue = 10;
  if (parseInt(input.innerHTML) < 10) {
    newValue = parseInt(input.innerHTML) + 1;
    input.innerHTML = newValue;
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Somthing went wrong!");
      }
    }
  }

  r.open("GET","cartQtyUpdateProcess.php?id="+id+"&q="+newValue,true);
  r.send();
}

// qty_inc_cart
