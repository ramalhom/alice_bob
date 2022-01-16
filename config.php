<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Alice & Bob : Le jeu</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Alice & Bob CSS -->
    <link href="css/alicebob.css" rel="stylesheet"/>
    <!-- Font CSS for Titles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Chilanka">
    <link rel="stylesheet" href="css/fontawesome/all.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mt-3"><img src="images/logo_alicebob.png" class="rounded mx-auto d-block img-fluid"></div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Alice & Bob : Le jeu</h1>
        </div>
    </div>
    <div id="config"></div>
    <div id="contentbd"></div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" class="form-border" onsubmit="cfg.del()">
                <div class="text-center">
                    <button type="submit" class="btn btn-warning btn-bigger"><i class="fa fa-sync"></i> Supprimer les sessions de la base de données
                    </button>
                </div>
            </form>
        <div class="col-md-12">
            <form method="post" class="form-border" onsubmit="cfg.create()">
                <div class="form-group">
                    <label for="session_id"><i class="fa fa-gamepad"></i> Numéro du jeu</label>
                    <input type="number" class="form-control" id="session_id" required>
                </div>
                <div class="form-group">
                    <label for="session_id"><i class="fa fa-thumbs-up"></i> URL du formulaire</label>
                    <input type="text" class="form-control" id="form_url" required>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-info btn-bigger"><i class="fa fa-share"></i> Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <span>Copyright 2022, Mario Ramalho, Icon by <a target="_blank" href="https://icons8.com">Icons8</a></span>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="public/config.js"></script>
<script type="text/javascript">
    window.addEventListener("load", cfg.displaybd);
</script>
</body>
</html>