<?php

$topics = $result["data"]['category'];

?>

<h1>liste topics</h1>

<?php
if(!$topics){
    echo "vide pour le moment";
} else {    
    
    foreach($topics as $topic ){
        
        ?>
        <p><?=$topic->getTitle()?></p>
        <p>Category : <?=$topic->getCategory()?></p>
        <p>Crée par <?=$topic->getUser()?> le <?=$topic->getCreationDate()?></p>
        <?php
    }
} 

