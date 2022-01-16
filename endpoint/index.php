<?php
// INIT
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "3a-config.php";
require PATH_LIB . "user.php";
$ab = new User();

// HANDLE REQUEST
switch ($_POST['req']) {
  // INVALID REQUEST
  default:
    echo "Invalid request";
    break;


  // LIST ENTRIES
  case "list":
    $user = $ab->getAll(); ?>
        <div class="row">
          <div class="col-md-12">
              <h2>Choisissez votre personnage</h2>
          </div>
        </div>
        <div class="row">
    <?php
    if (is_array($user)) {
        foreach ($user as $usr) { ?>

        <div class="col-md-6">
            <figure class="figure d-flex justify-content-center person">
                <a href="step.php?user=<?=$usr['name']?>">
                    <img src="images/<?=$usr['icon']?>" class="img-fluid"/>
                    <figcaption class="figure-caption text-center"><p><?=$usr['name']?></p></figcaption>
                </a>
            </figure>
        </div>
      <?php
    }} else {
      echo "<p>No users found</p>";
    }
    echo "</div>";
    break;
}
?>