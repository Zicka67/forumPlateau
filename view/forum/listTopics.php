<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><?=$topic->getTitle()?></p>
    <p>Category : <?=$topic->getCategory()?></p>
    <p>Crée par <?=$topic->getUser()?> le <?=$topic->getCreationDate()?></p>
    <?php
}


  
