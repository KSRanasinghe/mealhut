function addBanner(c) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "max") {
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(108,117,125);">Oops!</span>',
          })
          .set({
            transition: "zoom",
            button: "OK",
            message: "You have reached maximum banners count.",
          })
          .show();
      } else if (t == "show") {
        var addModal = document.getElementById("addModal");
        addModal = new bootstrap.Modal(addModal);
        addModal.show();
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error(t);
      }
    }
  };

  r.open("GET", "bannerCountProcess.php?c=" + c, true);
  r.send();
}

function add() {
  var title = document.getElementById("title").value;
  var desc = document.getElementById("desc").value;
  var img = document.getElementById("img");

  var f = new FormData();
  f.append("t", title);
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
        alertify.error("This title is already in use!");
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "addBannerProcess.php", true);
  r.send(f);
}

function update() {
  var id = document.getElementById("eid").value;
  var title = document.getElementById("etitle").value;
  var desc = document.getElementById("edesc").value;
  var img = document.getElementById("eimg");

  var f = new FormData();
  f.append("id", id);
  f.append("t", title);
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
        alertify.error("This title is already in use!");
      } else {
        alertify.set("notifier", "position", "bottom-left");
        alertify.warning(t);
      }
    }
  };

  r.open("POST", "editBannerProcess.php", true);
  r.send(f);
}

function status(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else if (t == "max") {
        alertify
          .alert()
          .set({
            title:
              '<span style="font-weight:bold; color: rgb(108,117,125);">Oops!</span>',
          })
          .set({
            transition: "zoom",
            button: "OK",
            message: "You have reached maximum banners count.",
          })
          .show();
      } else if (t == "error") {
        alertify.set("notifier", "position", "bottom-left");
        alertify.error("Something went wrong!");
      }
    }
  };

  r.open("GET", "changeBannerStatus.php?id=" + id, true);
  r.send();
}
