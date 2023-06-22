// get otp when reg

function otp() {
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var email = document.getElementById("email").value;

  var f = new FormData();
  f.append("f", fname);
  f.append("l", lname);
  f.append("e", email);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>',
          })
          .set({
            transition: "zoom",
            label: "OK",
            message: "OTP has been sent to your email. Check your inbox.",
            onok: function () {
              document.getElementById("email").setAttribute("readonly", true);
              document.getElementById("otpbtn").setAttribute("disabled", true);
              document.getElementById("otp").removeAttribute("disabled");
              document.getElementById("utype").removeAttribute("disabled");
              document.getElementById("pswd").removeAttribute("disabled");
              document.getElementById("repswd").removeAttribute("disabled");
              document.getElementById("regbtn").removeAttribute("disabled");
            },
          })
          .show();
      } else if (t == "error") {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Email address already in use!");
      } else if (t == "fail") {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Verification code sending failed!");
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "getAdminOtpProcess.php", true);
  r.send(f);
}

// get otp when reg

// register

function register() {
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var utype = document.getElementById("utype").value;
  var pswd = document.getElementById("pswd").value;
  var repswd = document.getElementById("repswd").value;
  var otp = document.getElementById("otp").value;
  var email = document.getElementById("email").value;

  var f = new FormData();
  f.append("f", fname);
  f.append("l", lname);
  f.append("u", utype);
  f.append("p", pswd);
  f.append("r", repswd);
  f.append("o", otp);
  f.append("e", email);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>',
          })
          .set({
            transition: "zoom",
            label: "OK",
            message: "You are now MealHut admin.",
            onok: function () {
              window.location.reload();
            },
          })
          .show();
      } else if (t == "no") {
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(108,117,125);">Oops!</span>',
          })
          .set({
            transition: "zoom",
            label: "OK",
            message: "Email is not verified yet.",
          })
          .show();
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "adminSignUpProcess.php", true);
  r.send(f);
}

// register

// login

function login(){

  var uname = document.getElementById("uname");
  var lgpswd = document.getElementById("lgpswd");

  var f = new FormData();
  f.append("u",uname.value);
  f.append("p",lgpswd.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "dashboard.php";

      } else if (t == "invalid") {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Invalid email or password!");
        
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  }

  r.open("POST","adminSignInProcess.php",true);
  r.send(f);
}

// login

//logout

function logout(){

  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if (r.readyState == 4) {
      var t = r.responseText;
      if(t == "success"){
        window.location = "admin-entrance.php";
      }
    }
  }

  r.open("GET","adminSignoutProcess.php",true);
  r.send();
}

//logout

function status (id){
  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else if(t == "sorry"){
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(108,117,125);">Oops!</span>',
          })
          .set({
            transition: "zoom",
            label: "OK",
            message: "You cannot change the status of the account you are currently logged into.",
          })
          .show();
      } else if(t == "error"){
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Something went wrong!");
      }
    }
  }

  r.open("GET","changeUserStatus.php?id="+id,true);
  r.send();
}
