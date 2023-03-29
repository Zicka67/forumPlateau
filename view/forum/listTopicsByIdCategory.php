<?php
$topics = $result["data"]["topics"];
$category = $result["data"]["category"];
?>

<h1>liste des topics <?=$category->getLabel()?></h1>
<!-- On va chercher dans le construct getLabel avec la $category qui a accées aux data -->

<?php
if(!$topics){
    echo "vide pour le moment";
    
} else {    
    
    foreach($topics as $topic ){
        ?>
        <a href="index.php?ctrl=forum&action=listPostsByIdTopic&id=<?=$topic->getId()?>"> <br>Title: -<?= $topic->getTitle()?><?= $topic->getUser() ?><br></a>
        <?php
    }
    
    
    
    
    
    
} ?>