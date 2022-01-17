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
        <?php if (isset($_GET['user'])) {
            $_SESSION['user'] = $_GET['user'];
            if (!isset($_GET['step'])) {
                $_SESSION['step'] = 1;
            } else {
                $_SESSION['step'] = $_GET['step'];
            }

        ?>
            <div class="row">

                <div class="col-md-4">
                    <h1 id="username"><?= $_GET['user'] ?></h1>
                </div>
                <div class="col-md-6">
                    <p class="session">Jeu n° <?= $_SESSION['session_id'] ?></p>
                </div>
                <div class="col-md-2">
                    <p><img src="images/<?= strtolower($_GET['user']) ?>.png" class="img-fluid" /></p>
                </div>
            </div>
        <?php } ?>
        <?php
        if (isset($_SESSION['session_id'])) {
        ?>
            <div id="step">
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="col-md-12">
                    <p class="attention">Aucune session n'est active.</p>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <span>Made with <i class="fa fa-heart"></i> by Mario Ramalho, Icon by <a target="_blank" href="https://icons8.com">Icons8</a></span>
            </div>
        </div>
    </div>
    <!-- Modal step1 -->
    <div class="modal fade" id="step1Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width: 100%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Méthode 1 : sans cryptage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe width="870" height="400" src="https://www.youtube.com/embed/JMqfMfjydnM" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal step2 -->
    <div class="modal fade" id="step2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width: 100%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Méthode 2 : cryptage symétrique</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe width="870" height="400" src="https://www.youtube.com/embed/F9vCcHqzvSs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal step3 -->
    <div class="modal fade" id="step3Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width: 100%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Méthode 3 : cryptage asymétrique</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe width="870" height="400" src="https://www.youtube.com/embed/S_GmuphyA3c" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="public/step.js"></script>
</body>

</html>