<?php
$category = ($result["data"]['topic']);
?>

<h1>Modifier le titre du topic</h1>

<form method="post">
    <p>
        <label>
            modifier le titre du topic<br>
            <input type="text" name="title" value="<?= $category->getTitle()?>">
        </label>
    </p><br>
        <input type="submit" value="Modifier">
</form>