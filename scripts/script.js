function signIn(){
    window.location = "signIn.php";
}

function myacc(){
    window.location = "myaccount.php";
}

function mobile(){
    window.location = "changemobile.php";
}

function email(){
    window.location = "changeemail.php";
}

function password(){
    window.location = "changepassword.php";
}

function address(){
    window.location = "addresslist.php";
}

function history(){
  window.location = "orderhistory.php";
}

function signOut() {
    var r = new XMLHttpRequest();
  
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        if (t == "success") {
          window.location = "index.php";
        }
      }
    };
  
    r.open("GET", "memberSignoutProcess.php", true);
    r.send();
  }

function goToCart(){
  window.location = "cart.php";
}