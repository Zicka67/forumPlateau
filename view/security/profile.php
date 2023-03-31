<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Profile</title>

</head>
<body>

<nav>
<div id="nav-left">
<a href="index.php">Accueil</a>
<?php
//Fait planter le cache pour le moment
if(App\Session::isAdmin()){
    ?>
    <a href="index.php?ctrl=Forum&action=addTopic">Edit un topic</a>
    <a href="index.php?ctrl=Forum&action=addCategory">Edit une categorie</a>
    <a href="index.php?ctrl=Security&action=listUsers">Liste des utilisateurs</a>
    <?php
}
?>
</div>
<div id="nav-right">
<?php

if(App\Session::getUser()){
    ?>
    <a href="index.php?ctrl=Security&action=showProfile"><span class="fas fa-user"></span> <?= App\Session::getUser()?></a>
    <a href="index.php?ctrl=Security&action=logout">Déconnexion</a>
    <?php
}
else{
    ?>
    <a href="index.php?ctrl=Security&action=login">Connexion</a>
    <a href="index.php?ctrl=Security&action=addUser">Inscription</a>
    <a href="index.php?ctrl=forum&action=listCategories">la liste des categories</a>
    <?php
}


?>
</div>
</nav>

<?php


// Vérifie si l'utilisateur est connecté
if (isset($_SESSION["user"])) {
    // Récupère l'utilisateur connecté
    $user = $_SESSION["user"];
    ?>
    <p>Pseudo : <?= $user->getPseudo(); ?></p>
    <p>Role : <?= $user->getRole(); ?></p>
    <p>Date d'inscription : <?= $user->getDateCreate(); ?></p>
    <p>Email : <?= $user->getEmail(); ?></p>
    <!-- <?php var_dump($user->getStatus());die; ?> -->
    <?php
    // Vérifie si l'utilisateur est banni
    if ($user->getStatus() == 0) {
        // var_dump($user->getStatus());die;
        echo "<p> Etat du compte : Votre compte a été banni par un administrateur.</p>";
    }
} else {
    
}
?>

</body>
</html>
