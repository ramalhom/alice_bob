var msg = {
  list: function () {
  // list() : show all the address entries

    // APPEND FORM DATA
    var data = new FormData();
    data.append('req', 'list');

    // AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "endpoint/step.php", true);
    xhr.onload = function(){
      if (xhr.status==403 || xhr.status==404) {
        alert("ERROR OPENING FILE!");
      } else {
        var step = document.getElementById("step");
        if (step != null) {
          step.innerHTML = this.response;
        }
      }
    };
    xhr.send(data);
  },
  save : function () {
    // save() : save message

    // APPEND FORM DATA
    var data = new FormData();

    data.append('req', 'save');
    data.append('session_id', document.getElementById("msg_session_id").value);
    data.append('username', document.getElementById("msg_username").value);
    data.append('step', document.getElementById("msg_step").value);
    data.append('private_key', document.getElementById("msg_private_key").value);
    data.append('public_key', document.getElementById("msg_public_key").value);
    data.append('crypted_with', document.getElementById("msg_crypted_with").value);
    data.append('message', document.getElementById("msg_message").value);

    // AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "endpoint/step.php", true);
    xhr.onload = function(){
      if (xhr.status==403 || xhr.status==404) {
        alert("ERROR OPENING FILE!");
      } else {
        if (this.response=="OK") {
          alert("Action effectué!")
          msg.list();
        } else {
          alert("Une erreur s'est produite!");
        }
      }
    };
    xhr.send(data);
    return false;
  }
};
window.addEventListener("load", msg.list);


