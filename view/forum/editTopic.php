<?php if(isset($result["data"]["category"])){
    $category = $result["data"]["category"];
}
if(isset($_SESSION["user"])){
    ?>
    
    <h1 class="categoryList">EDIT TOPIC</h1>
    
    <?php if (App\Session::isAdmin()): ?>
        <form method="POST" action="index.php?ctrl=Forum&action=addTopic">
                <div class="containerMain">
                <div class="topicContainerAdd">
        <label for="">
                Ajouter un topic : <br>
                <input type="text" name="title" value="">
        </label>         
        <label for="">
                <textarea name="message" placeholder="Ici ton message" rows="8" cols="100"></textarea>
        </label>
        </div>
                <input class="buton" type="submit" name="modifier" value="Ajouter">
        </div>
        </form>
        <?php endif;?>
        <?php
    }
    ?>
