<?php
$topics = $result["data"]["topics"];
$category = $result["data"]["category"];
?>

<h1 class="categoryList">liste des topics <?=$category->getLabel()?></h1>

    <div class="containerMain">
    <a class="addTopicContainer" href="index.php?ctrl=Forum&action=addTopic&id=<?= $category->getId()?>">Ajouter un topic</a>
    </div>
    <!-- On va chercher dans le construct getLabel avec la $category qui a accées aux data -->
    <div>
    <?php if(!$topics){ ?>
        <div class="centerTopics">Vide pour le moment</div>
        <?php } else { ?>
            <?php foreach($topics as $topic){ ?>
                <div class="containerMain">
                    <div class="topicContainer">
                        <a href="index.php?ctrl=forum&action=listPostsByIdTopic&id=<?=$topic->getId()?>"><br><?= $topic->getTitle() ?> <span>crée le</span> <?= DateTime::createFromFormat('d/m/Y, H:i:s', $topic->getCreationDate())->format('d/m/Y') ?> <span>par</span>  <?=$topic->getUser()->getPseudo() ?><br></a>
                </div>
                </div>
                <?php } ?>
                <?php } ?>
    </div>