<?php
$categories = $result["data"]["categories"];
?>

<h1 class="categoryList">liste des categories</h1>



<?php
if(!$categories){
    echo "vide pour le moment";
} else {    
    
    foreach($categories as $category) {
        ?>
        <div class="containerMainCategory">
            <?php if (isset($category)) { ?>
            <div class="categoryContainer">
                <a class="categoryLink" href="index.php?ctrl=forum&action=listTopicsByIdCategory&id=<?=$category->getId()?>"> <br> <?=$category->getLabel()?></a> 
                <?php if(App\Session::isAdmin()){ ?>
                    <a class="supprimerCategory" href="index.php?ctrl=forum&action=deleteCategory&id=<?=$category->getId()?>">supprimer</a>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <?php
    }
    } 
    ?>
  