<?php
$topics = $result["data"]["topics"];
$category = $result["data"]["category"];
?>

<h1 class="categoryList">liste des topics
<?= $category->getLabel() ?>
</h1>

<!-- On va chercher dans le construct getLabel avec la $category qui a accées aux data -->
<?php if (!$topics) { ?>
    
    
    <div class="centerTopics">Vide pour le moment</div>
    <?php } else { ?>
        <div class="containerMainTopic">
        <div class="containerMainAdd">
        <a class="addTopicContainer" href="index.php?ctrl=Forum&action=addTopic&id=<?= $category->getId() ?>">Ajouter un
        topic</a>
        </div>
        <?php foreach ($topics as $topic) { ?>
            <div class="topicContainer">
            
            <div class="flexTopic">
            <a href="index.php?ctrl=forum&action=listPostsByIdTopic&id=<?= $topic->getId() ?>">
            <br>
            <?= $topic->getTitle() ?>
            </div>
            <div>
            <span>crée le</span>
            <?= DateTime::createFromFormat('d/m/Y, H:i:s', $topic->getCreationDate())->format('d/m/Y') ?>
            <span>par</span>
            <?= $topic->getUser()->getPseudo() ?>
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
        <i class="fa-solid <?= $topic->isClosed() ? 'fa-unlock green' : 'fa-lock red' ?>"></i>
    <?php } ?>
</div>

        <?php } ?>
    </div>
<?php } ?>
                            
