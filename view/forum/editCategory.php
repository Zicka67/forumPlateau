<?php
$category = ($result["data"]['category']);
?>

<h1>Modifier la catégorie</h1>

<form method="post">
    <p>
        <label>
            modifier le label de la catégorie : <br>
            <input type="text" name="label" value="<?= $category->getLabel()?>">
        </label>
    </p><br>
        <input type="submit" value="Modifier">
</form>