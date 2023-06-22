function changeView() {
    var orBtn = document.getElementById("orBtn");
    var hotline = document.getElementById("hotline");
  
    orBtn.classList.toggle("d-none");
    hotline.classList.toggle("d-none");
  }

  function send(){
    var title = document.getElementById("title");
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var cemail = document.getElementById("cemail");
    var inq = document.getElementById("inq");
    var mobile = document.getElementById("mobile");
    var msg = document.getElementById("msg");

    var f = new FormData();
    f.append("t",title.value);
    f.append("f",fname.value);
    f.append("l",lname.value);
    f.append("e",email.value);
    f.append("ce",cemail.value);
    f.append("i",inq.value);
    f.append("m",mobile.value);
    f.append("msg",msg.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function(){
      if(r.readyState == 4){
        var t = r.responseText;

        if(t == "success1"){

          alertify.alert().set(
            {title:'<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>'}).set({
            'transition':'zoom',
            'label':'OK',
            'message':'We got your feedback. Our team will contact you soon.',
            'onok': function(){window.location = "feedback.php";}
          }).show();
  
        }else if(t == "success2"){
  
          alertify.alert().set(
            {title:'<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>'}).set({
            'transition':'zoom',
            'label':'OK',
            'message':'Thanks for your valuable feedback.',
            'onok': function(){window.location = "feedback.php";}
          }).show();
  
        }else if(t == "success3"){
  
          alertify.alert().set(
            {title:'<span style="font-weight:bold; color: rgb(25,135,84);">Yes!</span>'}).set({
            'transition':'zoom',
            'label':'OK',
            'message':'We got your feedback. Our team will contact you soon.',
            'onok': function(){window.location = "feedback.php";}
          }).show();
  
        }else{
          alertify.set("notifier", "position", "bottom-left");
          alertify.warning(t);
  
        }
      }
    }

    r.open("POST","feedbackProcess.php",true);
    r.send(f);
  }