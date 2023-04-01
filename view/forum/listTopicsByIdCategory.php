<?php
$topics = $result["data"]["topics"];
$category = $result["data"]["category"];
// var_dump($category); die;
?>

<h1 class="categoryList">liste des topics <?=$category->getLabel()?></h1>
            <div class="containerMain">
                <a class="addTopicContainer" href="index.php?ctrl=Forum&action=addTopic&id=<?php echo $id; ?>">Ajouter un topic</a>
            </div>
<!-- On va chercher dans le construct getLabel avec la $category qui a accées aux data -->

<?php
if(!$topics){
    echo "vide pour le moment";
    
} else {    
    
    foreach($topics as $topic ){
        ?>
        <div class="containerMain">
            <div class="topicContainer">
                <a href="index.php?ctrl=forum&action=listPostsByIdTopic&id=<?=$topic->getId()?>"><br><?= $topic->getTitle() ?> <span>crée le</span> <?= DateTime::createFromFormat('d/m/Y, H:i:s', $topic->getCreationDate())->format('d/m/Y') ?> <span>par</span>  <?=$topic->getUser() ?><br></a>
            </div>
        </div>
        <?php
    }
    
} ?>