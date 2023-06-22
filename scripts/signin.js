function changeView() {
  var loginCard = document.getElementById("loginCard");
  var registerCard = document.getElementById("registerCard");

  loginCard.classList.toggle("d-none");
  registerCard.classList.toggle("d-none");
}

function backHome() {
  window.location = "index.php";
}

function register() {
  var title = document.getElementById("title");
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var email = document.getElementById("email");
  var pswd = document.getElementById("pswd");
  var repswd = document.getElementById("repswd");

  var usernameOp = 0;

  if (document.getElementById("phone").checked) {
    usernameOp = 1;
  } else if (document.getElementById("mail").checked) {
    usernameOp = 2;
  }

  var f = new FormData();
  f.append("t", title.value);
  f.append("f", fname.value);
  f.append("l", lname.value);
  f.append("m", mobile.value);
  f.append("e", email.value);
  f.append("p", pswd.value);
  f.append("r", repswd.value);
  f.append("u", usernameOp);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      
      if (t == "success") {
        alertify.alert().set(
          {title:'<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>'}).set({
          'transition':'zoom',
          'label':'OK',
          'message':'You are now MealHut friend.',
          'onok': function(){window.location = "signIn.php";}
        }).show();

      } else if (t == "exists") {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("User with the same Email address or Mobile number already exists!");
        
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "memberSignupProcess.php", true);
  r.send(f);
}

function signin() {
  var username = document.getElementById("uname");
  var password = document.getElementById("spswd");
  var remember = document.getElementById("rm");
  
  var f = new FormData();
  f.append("u",username.value);
  f.append("p",password.value);
  f.append("r",remember.checked);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "orderdetails.php";

      } else if (t == "block") {
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(108,117,125);">Oops!</span>',
          })
          .set({
            transition: "zoom",
            button: "OK",
            message: "Your account has been blocked by the administration. Please contact our MealHut support team.",
            onok: function(){window.location = "feedback.php";}
          })
          .show();
        
      } else if (t == "invalid") {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Invalid email or password!");
        
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  }

  r.open("POST","memberSigninProcess.php",true);
  r.send(f);
}

// myaccount js

function save(id){

  var mid = id;
  var title = document.getElementById("title");
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");

  var usernameOp = 0;

  if (document.getElementById("phone").checked) {
    usernameOp = 1;
  } else if (document.getElementById("mail").checked) {
    usernameOp = 2;
  }

  var f = new FormData();
  f.append("id", mid);
  f.append("t", title.value);
  f.append("f", fname.value);
  f.append("l", lname.value);
  f.append("u", usernameOp);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      if(t == "success"){

        alertify.alert().set(
          {title:'<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>'}).set({
          'transition':'zoom',
          'label':'OK',
          'message':'Your account updated successfully.',
          'onok': function(){window.location = "myaccount.php";}
        }).show();

      }else if(t == "signin"){

        alertify.alert().set(
          {title:'<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>'}).set({
          'transition':'zoom',
          'label':'OK',
          'message':'Your account updated successfully.',
          'onok': function(){window.location = "signIn.php";}
        }).show();

      }else if(t == "error"){

        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Somthing went wrong!");

      }else{
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);

      }
    }
  }

  r.open("POST","memberAccountUpdateProcess.php",true);
  r.send(f);
}

// myaccount js

// changeMobile

function changeMobile(){
  var exmobile = document.getElementById("exmobile");
  var newmobile = document.getElementById("newmobile");
  var ncmobile = document.getElementById("ncmobile");

  var f = new FormData();
  f.append("em",exmobile.value);
  f.append("nm",newmobile.value);
  f.append("ncm",ncmobile.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function (){
    if(r.readyState == 4){
      var t = r.responseText;
      
      if(t == "success"){

        alertify.alert().set(
          {title:'<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>'}).set({
          'transition':'zoom',
          'label':'OK',
          'message':'Your phone number changed successfully.',
          'onok': function(){window.location = "myaccount.php";}
        }).show();

      }else if(t == "signin"){

        alertify.alert().set(
          {title:'<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>'}).set({
          'transition':'zoom',
          'label':'OK',
          'message':'Your phone number changed successfully.',
          'onok': function(){window.location = "signIn.php";}
        }).show();

      }else if(t == "error"){

        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Somthing went wrong!");

      }else{
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);

      }

    }
  }

  r.open("POST","changeMobileProcess.php",true);
  r.send(f);
}

// changeMobile

// changeEmail

function changeEmail(){
  var exemail = document.getElementById("exemail");
  var newemail = document.getElementById("newemail");
  var cnemail = document.getElementById("cnemail");

  var f = new FormData();
  f.append("ex",exemail.value);
  f.append("ne",newemail.value);
  f.append("nce",cnemail.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function (){
    if(r.readyState == 4){
      var t = r.responseText;
      
      if(t == "success"){

        alertify.alert().set(
          {title:'<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>'}).set({
          'transition':'zoom',
          'label':'OK',
          'message':'Your email changed successfully.',
          'onok': function(){window.location = "myaccount.php";}
        }).show();

      }else if(t == "signin"){

        alertify.alert().set(
          {title:'<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>'}).set({
          'transition':'zoom',
          'label':'OK',
          'message':'Your email changed successfully.',
          'onok': function(){window.location = "signIn.php";}
        }).show();

      }else if(t == "error"){

        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Somthing went wrong!");

      }else{
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);

      }

    }
  }

  r.open("POST","changeEmailProcess.php",true);
  r.send(f);
}

// changeEmail

// changePassword

function changePassword(){
  var expswd = document.getElementById("expswd");
  var newpswd = document.getElementById("newpswd");
  var ncpswd = document.getElementById("ncpswd");

  var f = new FormData();
  f.append("ex",expswd.value);
  f.append("np",newpswd.value);
  f.append("ncp",ncpswd.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function (){
    if(r.readyState == 4){
      var t = r.responseText;
      
      if(t == "signin"){

        alertify.alert().set(
          {title:'<span style="font-weight:bold; color: rgb(25,135,84);">SUCCESS</span>'}).set({
          'transition':'zoom',
          'label':'OK',
          'message':'Your password changed successfully!',
          'onok': function(){window.location = "signIn.php";}
        }).show();

      }else{
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);

      }

    }
  }

  r.open("POST","changePasswordProcess.php",true);
  r.send(f);
}

// changePassword

// forgotPassword

var memail;

function submit() {

  var email = document.getElementById("email").value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function (){
    if(r.readyState == 4){
      var t = r.responseText;
      if(t == "success"){
        memail = email;
        alertify
        .alert()
        .set({
          title:
            '<span style="font-weight:bold; color: rgb(25,135,84); fo">SUCCESS !</span>',
        })
        .set({
          transition: "zoom",
          label: "OK",
          message: "Verification code has been sent to your email.",
          onok: function(){
            var emailcard = document.getElementById("emailcard");
            var resetcard = document.getElementById("resetcard");
          
            emailcard.classList.toggle("d-none");
            resetcard.classList.toggle("d-none");
          },
        })
        .show();

      }else if(t == "error"){

        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Email address not found!");

      }else if(t == "fail"){

        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Verification code sending failed!");

      }else{
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);

      }
    }
  }

  r.open("GET","requestVerifyCodeProcess.php?e="+email,true);
  r.send();
}

function backToEmail() {
  var emailcard = document.getElementById("emailcard");
  var resetcard = document.getElementById("resetcard");

  emailcard.classList.toggle("d-none");
  resetcard.classList.toggle("d-none");
}

// forgotPassword

// resetPassword

function resetPassword(){
  var vc = document.getElementById("vc").value;
  var newpswd = document.getElementById("newpswd").value;
  var ncpswd = document.getElementById("ncpswd").value;

  var f = new FormData();
  f.append("vc",vc);
  f.append("np",newpswd);
  f.append("ncp",ncpswd);
  f.append("e",memail);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function (){
    if(r.readyState == 4){
      var t = r.responseText;
      if(t == "success"){
        alertify
        .alert()
        .set({
          title:
            '<span style="font-weight:bold; color: rgb(25,135,84); fo">SUCCESS !</span>',
        })
        .set({
          transition: "zoom",
          label: "OK",
          message: "Your password has changed successfully.",
          onok: function(){window.location = "signIn.php"},
        })
        .show();

      }else if(t == "error"){

        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Invalid verification code!");

      }else{
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);

      }
    }
  }

  r.open("POST","resetPasswordProcess.php",true);
  r.send(f);
}

// resetPassword

// changePickup

function changePickup(){
 
  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "orderdetails.php";
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Something went wrong!");
      }
    }
  }

  r.open("GET","pickupChangeProcess.php",true);
  r.send();
}

// changePickup