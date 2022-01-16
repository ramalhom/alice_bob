<?php
// INIT
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "3a-config.php";
require PATH_LIB . "user.php";
require PATH_LIB . "message.php";
$ab = new User();
$msg = new Message();

// HANDLE REQUEST
switch ($_POST['req']) {
        // INVALID REQUEST
    default:
        echo "Invalid request";
        break;

        // SAVE ENTRY
    case "save":
        echo $msg->save($_POST['message'], $_POST['private_key'], $_POST['public_key'], $_POST['crypted_with'], $_POST['session_id'], $_POST['step'], $_POST['username']) ? "OK" : "ERR";
        break;

        // LIST ENTRIES
    case "list":
        session_start();
        if (isset($_SESSION['user'])) {
            $session_id = $_SESSION['session_id'];
            $username = $_SESSION['user'];
            $step = $_SESSION['step'];
            $message = $msg->get($session_id, $step, 'Alice');
            if ($step == 1) {
?>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Méthode 1: sans cryptage</h2>
                        <img src="images/step1.png" class="img_step" />
                        <p>Alice envoie un message à Bob sur Internet sans cryptage.</p>
                        <div class="text-center mb-2">
                            <button type="button" class="btn btn-info btn-bigger" data-toggle="modal" data-target="#step1Modal">
                                <i class="fa fa-info-circle"></i> Comprendre la méthode
                            </button>
                        </div>


                    </div>
                </div>
            <?php
            } else if ($step == 2) {
            ?>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Méthode 2: cryptage symétrique</h2>
                        <img src="images/step2.png" class="img_step" />
                        <p>Alice envoie un message à Bob sur Internet avec un cryptage symétrique.</p>
                        <div class="text-center mb-2">
                            <button type="button" class="btn btn-info btn-bigger" data-toggle="modal" data-target="#step2Modal">
                                <i class="fa fa-info-circle"></i> Comprendre la méthode
                            </button>
                        </div>
                    </div>
                </div>
            <?php
            } else if ($step == 3) {
            ?>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Méthode 3: cryptage asymétrique</h2>
                        <img src="images/step3.png" class="img_step" />
                        <p>Alice envoie un message à Bob sur Internet avec un cryptage asymétrique.</p>
                        <div class="text-center mb-2">
                            <button type="button" class="btn btn-info btn-bigger" data-toggle="modal" data-target="#step3Modal">
                                <i class="fa fa-info-circle"></i> Comprendre la méthode
                            </button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="row">
                <?php
                switch ($username) {
                    case 'Alice':
                        $messageBob = $msg->get($session_id, $step, 'Bob');
                ?>
                        <div class="col-md-12">
                            <form class="form-border" onsubmit="return msg.save()">
                                <div class="form-group">
                                    <input type="hidden" id="msg_session_id" value="<?= $session_id ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="msg_username" value="<?= $username ?>" />
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="msg_step" value="<?= $step ?>" />
                                </div>
                                <?php if ($step > 1) { ?>
                                    <div class="form-group">
                                        <label for="msg_private_key"><i class="fa fa-key"></i> Clé privée (nombre entier)</label>
                                        <input type="number" class="form-control" id="msg_private_key" value="<?= $message[1] ?>" required>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <input type="hidden" id="msg_private_key" value="" />
                                    </div>
                                <?php } ?>
                                <?php if ($step > 2) { ?>
                                    <div class="form-group">
                                        <label for="msg_public_key"><i class="fa fa-key"></i> Clé publique de <?= $username ?> (nombre entier)</label>
                                        <input type="number" class="form-control" id="msg_public_key" value="<?= $message[2] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="msg_public_key_bob"><i class="fa fa-key"></i> Clé publique de Bob <a href="javascript:msg.list()"><i class="fas fa-sync"></i> Rafraîchir</a> </label>
                                        <?php if (isset($messageBob[2])) { ?>
                                            <p class="message"><?= $messageBob[2] ?></p>
                                        <?php } else { ?>
                                            <p class="message"><i>Aucune clé définie</i></p>
                                        <?php } ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <input type="hidden" id="msg_public_key" value="" />
                                    </div>
                                <?php } ?>
                                <?php if ($step > 2) { ?>
                                    <div class="form-group">
                                        <label for="message"><i class="fa fa-lock"></i> Crypter avec ...</label>
                                        <select class="custom-select" id="msg_crypted_with" required>
                                            <option value="private_key_alice" <?php if ($message[3] == "private_key_alice") echo " selected"; ?>>Clé privé de Alice</option>
                                            <option value="public_key_alice" <?php if ($message[3] == "public_key_alice") echo " selected"; ?>>Clé publique de Alice</option>
                                            <option value="public_key_bob" <?php if ($message[3] == "public_key_bob") echo " selected"; ?>>Clé publique de Bob</option>
                                        </select>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <input type="hidden" id="msg_crypted_with" value="" />
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="msg_message"><i class="fa fa-comment"></i> Message</label>
                                    <input type="text" class="form-control" id="msg_message" value="<?= $message[0] ?>" required>
                                </div>
                                <div class="text-right">
                                    <?php if ($step > 1) { ?>
                                        <button type="submit" class="btn btn-info btn-bigger"><i class="fa fa-lock"></i> Crypter et <i class="fa fa-share"></i> envoyer</button>
                                    <?php } else { ?>
                                        <button type="submit" class="btn btn-info btn-bigger"><i class="fa fa-share"></i> Envoyer</button>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>

                    <?php
                        break;
                    default:
                        $message = $msg->get($session_id, $step, 'Alice');
                        $messageUser = $msg->get($session_id, $step, $username);

                        $display = "<i>Aucun message</i>";
                        if (is_array($message)) {
                            $display = $message[0];
                            if ($step == 2 and $message[1] != $messageUser[1]) {
                                $display = $msg->crypt($message[0]);
                            }
                            if ($step == 3 and ($message[3] != "public_key_bob" or $messageUser[3] != "private_key_bob")) {
                                $display = $msg->crypt($message[0]);
                            }
                        }
                    ?>
                        <?php if ($step > 1) { ?>
                            <div class="col-md-12">
                                <form class="form-border" onsubmit="return msg.save()">
                                    <div class="form-group">
                                        <input type="hidden" id="msg_session_id" value="<?= $session_id ?>" />
                                        <input type="hidden" id="msg_username" value="<?= $username ?>" />
                                        <input type="hidden" id="msg_step" value="<?= $step ?>" />
                                        <input type="hidden" id="msg_message" value="" />
                                        <?php if ($step > 1) { ?>
                                            <label for="msg_private_key"><i class="fa fa-key"></i> Ma clé privée (nombre entier)</label>
                                            <input type="number" class="form-control" id="msg_private_key" value="<?= $messageUser[1] ?>" required>
                                        <?php } else { ?>
                                            <input type="hidden" id="msg_private_key" value="" />
                                        <?php } ?>
                                        <?php if ($step > 2 and $username != 'Trudi' and $username != 'Eve') { ?>
                                            <label for="msg_public_key"><i class="fa fa-key"></i> Ma clé publique (nombre entier)</label>
                                            <input type="number" class="form-control" id="msg_public_key" value="<?= $messageUser[2] ?>" required>
                                        <?php } else { ?>
                                            <input type="hidden" id="msg_public_key" value="" />
                                        <?php } ?>
                                        <?php if ($step > 2 and $username == 'Bob') { ?>
                                            <div class="text-right">
                                                <br />
                                                <button type="submit" class="btn btn-info btn-bigger"><i class="fa fa-share"></i> Envoyer</button>
                                            </div>
                                        <?php } ?>
                                        <?php if ($step > 2) { ?>
                                            <div class="form-group">
                                                <label for="message"><i class="fa fa-lock"></i> Décrypter avec ...</label>
                                                <select class="custom-select" id="msg_crypted_with" required>
                                                    <option value="public_key_alice" <?php if ($messageUser[3] == "public_key_alice") echo " selected"; ?>>Clé publique de Alice</option>
                                                    <option value="public_key_bob" <?php if ($messageUser[3] == "public_key_bob") echo " selected"; ?>>Clé publique de Bob</option>
                                                    <?php if ($username == 'Bob') { ?>
                                                        <option value="private_key_bob" <?php if ($messageUser[3] == "private_key_bob") echo " selected"; ?>>Clé privé de Bob</option>
                                                    <?php } else if ($username == 'Trudi') { ?>
                                                        <option value="private_key_trudi" <?php if ($messageUser[3] == "private_key_trudi") echo " selected"; ?>>Clé privé de Trudi</option>
                                                    <?php } else if ($username == 'Eve') { ?>
                                                        <option value="private_key_eve" <?php if ($messageUser[3] == "private_key_eve") echo " selected"; ?>>Clé privé de Eve</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <?php } else { ?>
                                            <div class="form-group">
                                                <input type="hidden" id="msg_crypted_with" value="" />
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info btn-bigger"><i class="fa fa-unlock"></i> Décrypter</button>
                                    </div>
                                </form>
                            </div>

                        <?php } ?>

                        <div class="col-md-8">
                            <h2>Le message de Alice</h2>
                        </div>
                        <div class="col-md-4">
                            <div class="text-right">
                                <button class="btn btn-secondary btn-bigger" onClick="msg.list()"><i class="fas fa-sync"></i> Rafraîchir</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="message"><?= $display ?></p>
                        </div>
            <?php
                        break;
                }
            } ?>
            <div class="col-md-12">
                <div class="text-right">
                    <?php if ($step < 3) { ?>
                        <a href="step.php?step=<?= $step + 1 ?>&user=<?= $username ?>" class="btn btn-link btn-bigger">Etape suivante</a>
                    <?php } else { ?>
                        <a href="final.php" class="btn btn-link btn-bigger">Etape suivante</a>
                    <?php } ?>
                </div>
            </div>
            </div>
    <?php
}
    ?>