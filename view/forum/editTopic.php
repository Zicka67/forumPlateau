<?php if(isset($result["data"]["category"])){
    $category = $result["data"]["category"];
}
if(isset($_SESSION["user"])){
    ?>
    
    <h1 class="categoryList">EDIT TOPIC</h1>
    
        <form method="POST" action="index.php?ctrl=Forum&action=addTopic&id=<?=$category->getId()?>"> <!-- Redirection vers l'id de la catégorie -->
        <div class="containerMain">
                <div class="topicContainerAdd">
                        <label for="">
                                Ajouter un topic : <br>
                                <input type="text" name="title" value="">
                        </label>         
                        <label for="">
                                <textarea name="message" placeholder="Ici ton message" rows="8" cols="80"></textarea>
                        </label>
                                <input class="buton" type="submit" name="modifier" value="Ajouter">
                        </form>
        
<?php } ?>
