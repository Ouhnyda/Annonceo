<?php require_once('inc/header.inc.php') ?>


<?php 

/*if (userConnect()) {//Si l'internaute est connecté, je le redirige vers son profil

	header('location:profil.php');
	exit();

}*/
//------------------------------------------------
  


if ( $_POST ){
  $error = '';

  if (strlen($_POST['pseudo']) <= 3 || strlen($_POST['pseudo']) >= 20) {
    //Si le pseudo est inferieur ou egale a 3 OU qu'il est sup a 20
    $error .= '<div class="alert alert-danger" role="alert">Erreur taille pseudo</div>';
  }

  $r = execute_requete("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
  if ($r->rowCount() >= 1) {
    $error .= '<div class="alert alert-danger" role="alert">Pseudo indisponible</div>';
  }

  foreach ($_POST as $key => $value) {
    $_POST[$key] = addslashes($value);
  }

  //Cryptage du mot de passe : 
  $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
  if (empty($error)) {
    execute_requete("INSERT INTO membre(pseudo, mdp, nom, prenom, email, sexe, tel) VALUES('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[sexe]','$_POST[tel]')");

    echo '<div class="alert alert-success" role="alert">Inscription validée !</div>';
  }

  //affichage des erreurs : 
  $content .=$error;
}

 ?>

<?= $content; ?>
                                      <!-- Modal -->


       


<?php require_once('inc/footer.inc.php') ?>