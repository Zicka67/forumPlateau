<?php
$topics = $result["data"]["topics"];
$category = $result["data"]["category"];
?>

<h1 class="topicList">liste des topics
<?= $category->getLabel() ?>
</h1>

<?php if (!App\Session::getUser()) { 
    // Affiche un message d'erreur
    echo "Veuillez vous connecter pour accéder à cette page.";
    // Arrête l'exécution du code
    exit();
} ?>

<!-- On va chercher dans le construct getLabel avec la $category qui a accées aux data -->
<?php if (!$topics) { ?>
    <div class="containerMainTopic2">
    <div class="containerMainAdd">
    <a class="addTopicContainer" href="index.php?ctrl=Forum&action=addTopic&id=<?= $category->getId() ?>">Ajouter un
        topic</a>
        </div>
        </div>
    <div class="centerTopics2">Vide pour le moment</div>
    <?php } else { ?>
        <div class="containerMainTopic">
        <div class="containerMainAdd">
        <a class="addTopicContainer" href="index.php?ctrl=Forum&action=addTopic&id=<?= $category->getId() ?>">Ajouter un
        topic</a>
        </div>
        <?php foreach ($topics as $topic) { 
            $lock = ($topic->getClosed()) ? 'fa-lock-open' : 'fa-lock';
            $color = ($topic->getClosed()) ? 'green' : 'red';
            ?>
            <div class="topicContainer">
            
            <div class="flexTopic">
            <a href="index.php?ctrl=forum&action=listPostsByIdTopic&id=<?= $topic->getId() ?>">
            <br>
            <strong><?= $topic->getTitle() ?></strong>
            </div>
            <div>
            <span>crée le</span>
            <span> <?= DateTime::createFromFormat('d/m/Y, H:i:s', $topic->getCreationDate())->format('d/m/Y') ?></span>
            <span>par</span>
            <span><?= $topic->getUser()->getPseudo() ?> </span>
            <!-- afficher le nombre de messages correspondant à chaque topic -->
            <span>(  <?= $topic->getCountPosts() ?> messages) </span>
            </div>
            </a>
            
            </div>
            <div class="adminPannel">
                <?php if (App\Session::isAdmin()) { ?>
                    <a class="supprimerTopic" href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer</a>
                <?php } ?> 
                <?php if(App\Session::isAdmin() || ($topic->getUser()->getId() == $_SESSION["user"]->getId())) { ?>
                    <a class="" href="index.php?ctrl=forum&action=closeTopic&id=<?= $topic->getId() ?>">(De)Verrouillage</a>  
                    <i class="fa-solid <?= $lock ?> <?= $color ?>"></i> 
                <?php } ?>
    </div>

                <?php } ?>
        </div>
<?php } ?>
                            
