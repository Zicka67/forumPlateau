<?php
$posts = ($result["data"]['post']);
?>

<h1>Modification du message</h1>

<form method="POST">
    <label>
        modifier le texte :<br>
        <textarea name="text">aa</textarea>
        <textarea name="text"><?= $post->getText()?></textarea>
    </label>
    <br>
    <input type="submit" value="Ajouter">
</form>