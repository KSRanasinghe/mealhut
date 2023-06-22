function confirm(a) {
  var confirm = 1;
  var amount = a;

  if (document.getElementById("tc").checked) {
    /* online payment */
    if (document.getElementById("online").checked) {
      window.location = "checkout.php?payment-option=" + confirm;
    /* onsite payment */
    } else if (document.getElementById("onsite").checked) {
      var f = new FormData();
      f.append("a", amount);

      var r = new XMLHttpRequest();
      r.onreadystatechange = function () {
        if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "success") {
            window.location = "success.php";
          }
        }
      };

      r.open("POST", "onSitePayProcess.php", true);
      r.send(f);
    }
  } else {
    alertify.set("notifier", "position", "bottom-left");
    alertify.warning("Please agree to Terms & Conditions.");
  }
}


function confirmo(id){
  var c = 1;
  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if (r.readyState == 4) {
      var t = r.responseText;
      if(t == "success"){
        window.location.reload();
      }else if(t == "error"){
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Something went wrong!");
      }
    }
  }

  r.open("GET","changeOrderStatus.php?id="+id+"&c="+c);
  r.send();
}

function cancel(id){
  var c = 2;
  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if (r.readyState == 4) {
      var t = r.responseText;
      if(t == "success"){
        window.location.reload();
      }else if(t == "error"){
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Something went wrong!");
      }
    }
  }

  r.open("GET","changeOrderStatus.php?id="+id+"&c="+c);
  r.send();
}