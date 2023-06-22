function addCategory() {
  var category = document.getElementById("cname").value;

  var f = new FormData();
  f.append("c", category);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else if (t == "error") {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Category has already added!");
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "addCategoryProcess.php", true);
  r.send(f);
}

function editCategory(){
  var id = document.getElementById("ecid").value;
  var category = document.getElementById("ecname").value;

  var f = new FormData();
  f.append("i", id);
  f.append("c", category);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      }  else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "editCategoryProcess.php", true);
  r.send(f);
}