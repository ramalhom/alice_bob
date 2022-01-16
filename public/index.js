var ab = {
  list: function () {
  // list() : show all the address entries

    // APPEND FORM DATA
    var data = new FormData();
    data.append('req', 'list');

    // AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "endpoint/index.php", true);
    xhr.onload = function(){
      if (xhr.status==403 || xhr.status==404) {
        alert("ERROR OPENING FILE!");
      } else {
        var users = document.getElementById("users");
        if (users != null) {
          users.innerHTML = this.response;
        }
      }
    };
    xhr.send(data);
  }
};

window.addEventListener("load", ab.list);