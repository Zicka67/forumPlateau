<?php
$topics = $result["data"]["topics"];
$category = $result["data"]["category"];

?>

<div class="categoryList">
    <a href="index.php?ctrl=category">Retour</a>
    <h3>Catégorie : <?= $category->getLabel() ?></h3>
    <a class="" href="index.php?ctrl=topic&action=addTopic&id=<?= $category->getId() ?>">NOUVEAU TOPIC</a>

    <?php if(isset($category)): ?>
        <p>Catégorie : <?= $category->getLabel() ?></p>
    <?php endif; ?>
</div>

<?php
if(!$topics){
    echo "vide pour le moment";
} else {    
    
    foreach($topics as $topic ){
        
        ?>
        <p><br><?=$topic->getTitle()?></p>
        <p>Category : <?=$topic->getCategory()?></p>
        <p>Crée par <?=$topic->getUser()?> le <?=$topic->getCreationDate()?></p>
        <?php
    }
} 







