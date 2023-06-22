function add() {
  window.location = "address.php";
}

function save() {
  var title = document.getElementById("title");
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var hno = document.getElementById("hno");
  var street = document.getElementById("street");
  var dis = document.getElementById("dis");
  var city = document.getElementById("city");
  var name = document.getElementById("aname");

  var f = new FormData();
  f.append("t", title.value);
  f.append("f", fname.value);
  f.append("l", lname.value);
  f.append("m", mobile.value);
  f.append("h", hno.value);
  f.append("s", street.value);
  f.append("d", dis.value);
  f.append("c", city.value);
  f.append("n", name.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "signin") {
        window.location = "signIn.php";
      } else if (t == "success") {
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>',
          })
          .set({
            transition: "zoom",
            label: "OK",
            message: "New address added.",
            onok: function () {
              window.location = "addresslist.php";
            },
          })
          .show();
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "addressAddProcess.php", true);
  r.send(f);
}

function sendId(id){
  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      if(t == "success"){
        window.location = "editaddress.php";
      }else{
        alert(t);
      }
    }
  }

  r.open("GET","sendAddressIdProcess.php?id="+id,true);
  r.send();
}

function update(id) {
  var aid = id;
  var title = document.getElementById("title");
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var hno = document.getElementById("hno");
  var street = document.getElementById("street");
  var dis = document.getElementById("dis");
  var city = document.getElementById("city");
  var name = document.getElementById("aname");

  var f = new FormData();
  f.append("id", aid);
  f.append("t", title.value);
  f.append("f", fname.value);
  f.append("l", lname.value);
  f.append("m", mobile.value);
  f.append("h", hno.value);
  f.append("s", street.value);
  f.append("d", dis.value);
  f.append("c", city.value);
  f.append("n", name.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "signin") {
        window.location = "signIn.php";

      } else if (t == "success") {
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>',
          })
          .set({
            transition: "zoom",
            label: "OK",
            message: "Address updated.",
            onok: function () {
              window.location = "addresslist.php";
            },
          })
          .show();

      }else if(t == "error"){
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Something went wrong!");

      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);

      }
    }
  };

  r.open("POST", "addressEditProcess.php", true);
  r.send(f);
}

function remove(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      if(t == "success"){
        window.location.reload();
      }else if (t == "error"){
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(108,117,125);">Oops!</span>',
          })
          .set({
            transition: "zoom",
            button: "OK",
            message: "There are meals ready to be sent to this address in your cart.",
            onok: function () {
              window.location = "cart.php";
            },
          })
          .show();
      } else{
        alertify.set("notifier", "position", "bottom-left");
        alertify.error(t);
      }
    }
  }

  r.open("GET","removeAddressProcess.php?id="+id,true);
  r.send();
  
}

function selectAddress(id,ch){
  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      if(t == "have"){
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(108,117,125);">Oops!</span>',
          })
          .set({
            transition: "zoom",
            button: "OK",
            message: "There are meals in your cart that have not been checked out.",
            onok: function () {
              window.location = "cart.php";
            },
          })
          .show();

      }else if(t == "success"){
        window.location = "menu.php";

      }else if(t == "updated"){
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>',
          })
          .set({
            transition: "zoom",
            label: "OK",
            message: "Delivery details changed.",
            onok: function () {
              window.location = "cart.php";
            },
          })
          .show();

      }else{
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Something went wrong!");
      }
    }
  }

  r.open("GET","selectAddressProcess.php?id="+id+"&ch="+ch,true);
  r.send();
}