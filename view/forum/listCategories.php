<?php

$categories = $result["data"]["categories"];

?>

<h1>liste Category</h1>

<?php
if(!$categories){
    echo "vide pour le moment";
} else {    
    
    foreach($categories as $category ){
        
        ?>
        <a href="index.php?ctrl=forum&action=listTopicsByIdCategory&id=<?=$category->getId()?>"> <br> - <?=$category->getLabel()?></a>

        <?php
    }
} 

