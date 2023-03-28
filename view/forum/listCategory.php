<?php

$categories = $result["data"]["category"];

?>

<h1>liste Category</h1>

<?php
if(!$categories){
    echo "vide pour le moment";
} else {    
    
    foreach($categories as $category ){
        
        ?>
        <p><?=$category->getId()?> - <?=$category->getLabel()?></p>

        <?php
    }
} 

