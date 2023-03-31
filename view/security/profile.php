<?php 
$user=$_SESSION["user"];
var_dump($user); die;
?>
<p>Pseudo : <?=$user->getPseudo();?></p>
<p>Role : <?=$user->getRole();?></p>
<p>Date d'inscription : <?=$user->getDateCreate();?></p>
<p>Email : <?=$user->getEmail();?></p>
<?php if($user->getBan()==1){

    echo "<p> Etat du compte : Votre compte a été banni par un administrateur.
    </p>";
}

?>