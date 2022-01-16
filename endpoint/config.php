<?php
// INIT
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "3a-config.php";
require PATH_LIB . "config.php";
$cfg = new Config();

// HANDLE REQUEST
switch ($_POST['req']) {
    // INVALID REQUEST
    default:
        echo "Invalid request";
        break;

    // DEL ENTRY
    case "del":
        echo $cfg->del() ? "OK" : "ERR";
        break;
    case "create":
        echo $cfg->create($_POST['session_id'], $_POST['form_url']) ? "OK" : "ERR";
        break;
    case "get":
        session_start();
        if (isset($_SESSION["session_id"]))
        {
            $config = $cfg->get($_SESSION["session_id"]);
            if (isset($config[0]))
            {
        ?>
                <div class="text-center">
                    <p>Merci de compléter le formulaire disponible ci-dessous. </p>
                    <a href="<?=$config[0]?>" class="btn btn-success btn-bigger"><i class="fa fa-thumbs-up"></i> Formulaire</a>
                </div>
        <?php
            }
        }

        break;
    case "displaybd":
        $displaybd = $cfg->displaybd();

        ?>
        <div class="text-center">
            <p>Nombre de jeu dans la base de données : <?=count($displaybd)?></p>
            <?php
                foreach($displaybd as $elt)
                {
                    $formulaire = $elt[1] == '' ? "aucun" : "<a href='" . $elt[1] . "' target='_blank'>" . $elt[1] . "</a>";
                    echo "[ID de jeu : " . $elt[0] . " | Formulaire : " . $formulaire . "]<br>";
                }
            ?>
        </div>
        <?php

        break;
}
?>