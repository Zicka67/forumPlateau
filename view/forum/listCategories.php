<?php
$categories = $result["data"]["categories"];
?>

<h1 class="categoryList">liste des categories</h1>

<?php
if(!$categories){
    echo "vide pour le moment";
} else {    
    
    foreach($categories as $category ){
        
        ?>
        <a class="categoryLink" href="index.php?ctrl=forum&action=listTopicsByIdCategory&id=<?=$category->getId()?>"> <br> - <?=$category->getLabel()?></a>
        <?php
    }
} 

