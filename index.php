<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Alice & Bob : Le jeu</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- Alice & Bob CSS -->
    <link href="css/alicebob.css" rel="stylesheet" />
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
                <p>Bienvenue sur le jeu Alice & Bob. <br>
                    Ce jeu vous permet de comprendre et d'expérimenter la
                    cryptographie symétrique et asymétrique. <a href="https://www.ramalho.ch/alice-bob"> Plus d'informations.</a></p>
            </div>
        </div>
        <?php
        if (isset($_GET['session_id'])) {
            $_SESSION['session_id'] = $_GET['session_id'];
        ?>
            <div id="users">
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="col-md-12">
                    <form class="form-border">
                        <div class="form-group">
                            <label for="session_id"><i class="fa fa-gamepad"></i> Numéro du jeu</label>
                            <input type="number" class="form-control" name="session_id" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-info btn-bigger"><i class="fa fa-share"></i> Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p><a href="config.php">Accès à la configuration</a></p>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <span>Made with <i class="fa fa-heart"></i>, Mario Ramalho, Icon by <a target="_blank" href="https://icons8.com">Icons8</a></span>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="public/index.js"></script>
</body>

</html>