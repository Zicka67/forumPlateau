<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
<link rel="stylesheet" href="public\css\style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;500;600;700&display=swap" rel="stylesheet">

<title>Profile</title>

</head>
<body>
    <div id="wrapper"> 
  
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
            <header>
                <nav class="profil-nav ">
                    <div id="nav-left">
                        <a href="index.php">Accueil</a>
                        <a href="index.php?ctrl=Forum&action=listCategories">Categories</a>
                        <?php
                       
                        if(App\Session::isAdmin()){
                         ?>
                           <!-- <a href="index.php?ctrl=Forum&action=addTopic">Edit un topic</a> -->
                           <a href="index.php?ctrl=Security&action=listUsers">Liste des utilisateurs</a>
                          <?php
                        }
                        ?>
                    </div>
                    <div id="nav-right">
                    <?php
                        
                        if(App\Session::getUser()){
                            ?>
                            <a href="index.php?ctrl=Security&action=showProfile"><span class="fas fa-user"></span> <?= ucfirst(App\Session::getUser()) ?></a>
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
                </header>
                <div class="forum2container">
                    <div id="forum2"  >
                     <?php
                     // Vérifie si l'utilisateur est connecté
                     if (isset($_SESSION["user"])) {
                         // Récupère l'utilisateur connecté
                         $user = $_SESSION["user"];
                         ?>
                         <p>Pseudo : <?= $user->getPseudo(); ?></p>
                         <p>Email : <?= $user->getEmail(); ?></p>
                         <p>Role : <?= $user->getRole(); ?></p>
                         <p>Date d'inscription : <?= $user->getDateCreate(); ?></p>


                        
                          <!-- <?php var_dump($user->getId());die; ?>  -->
                         <?php
                         // Vérifie si l'utilisateur est banni
                         if ($user->getStatus() == 0) {
                             // var_dump($user->getStatus());die;
                             echo "<p> Etat du compte : Votre compte a été banni par un administrateur.</p>";
                         }
                     } else {
    
                     }
                     ?>
                </div>
                     </div>
        </div>
    </div>
             

</body>
</html>
