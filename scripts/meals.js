function add() {
  var category = document.getElementById("category").value;
  var mname = document.getElementById("mname").value;
  var mtype = document.getElementById("mtype").value;
  var price = document.getElementById("price").value;
  var desc = document.getElementById("desc").value;
  var img = document.getElementById("img");

  var f = new FormData();
  f.append("c", category);
  f.append("mn", mname);
  f.append("mt", mtype);
  f.append("p", price);
  f.append("d", desc);
  f.append("i", img.files[0]);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else if (t == "have") {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("This meal has been already added!");
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "addMealProcess.php", true);
  r.send(f);
}

function update(){
  var id = document.getElementById("emid").value;
  var price = document.getElementById("eprice").value;
  var desc = document.getElementById("edesc").value;
  var img = document.getElementById("eimg");

  var f = new FormData();
  f.append("id", id);
  f.append("p", price);
  f.append("d", desc);
  f.append("i", img.files[0]);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else if (t == "have") {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("This meal has been already added!");
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "editMealProcess.php", true);
  r.send(f);
}

function status(id){
  var r = new XMLHttpRequest();
  r.onreadystatechange = function(){
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else if(t == "error"){
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Something went wrong!");
      }
    }
  }

  r.open("GET","changeMealStatus.php?id="+id,true);
  r.send();
}