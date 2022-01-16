var cfg = {
    del: function () {
        // list() : show all the address entries

        // APPEND FORM DATA
        var data = new FormData();
        data.append('req', 'del');

        // AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "endpoint/config.php", true);
        xhr.onload = function () {
            if (xhr.status == 403 || xhr.status == 404) {
                alert("ERROR OPENING FILE!");
            } else {
                if (this.response == "OK") {
                    alert("Action effectué!")
                } else {
                    alert("Une erreur s'est produite!");
                }
            }
        };
        xhr.send(data);
        return false;
    },
    create: function () {
        // save() : save message

        // APPEND FORM DATA
        var data = new FormData();

        data.append('req', 'create');
        data.append('session_id', document.getElementById("session_id").value);
        data.append('form_url', document.getElementById("form_url").value);

        // AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "endpoint/config.php", true);
        xhr.onload = function () {
            if (xhr.status == 403 || xhr.status == 404) {
                alert("ERROR OPENING FILE!");
            } else {
                if (this.response == "OK") {
                    alert("Action effectué!")
                } else {
                    alert("Une erreur s'est produite!");
                }
            }
        };
        xhr.send(data);
        return false;
    },
    get: function () {
        // save() : save message

        // APPEND FORM DATA
        var data = new FormData();

        data.append('req', 'get');

        // AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "endpoint/config.php", true);
        xhr.onload = function () {
            if (xhr.status == 403 || xhr.status == 404) {
                alert("ERROR OPENING FILE!");
            } else {
                var form_url = document.getElementById("form_url");
                if (form_url != null) {
                    form_url.innerHTML = this.response;
                }

            }
        };
        xhr.send(data);
        return false;
    },
    displaybd: function () {
        // save() : save message

        // APPEND FORM DATA
        var data = new FormData();

        data.append('req', 'displaybd');

        // AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "endpoint/config.php", true);
        xhr.onload = function () {
            if (xhr.status == 403 || xhr.status == 404) {
                alert("ERROR OPENING FILE!");
            } else {
                var form_url = document.getElementById("contentbd");
                if (form_url != null) {
                    form_url.innerHTML = this.response;
                }

            }
        };
        xhr.send(data);
        return false;
    }
};

