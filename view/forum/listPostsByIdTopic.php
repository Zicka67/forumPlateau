<?php
$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];

?>



<h1>La liste des messages dans le <?= $topic->getTitle() ?></h1>

<?php
if(!$posts){
    echo "vide pour le moment";
    
} else { ?>
    <table class="listTable">
    <thead>
        <tr>
            <th>message</th>
            <th>auteur</th>
            <th>date</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($posts as $post){
        ?>
        <tr>
            <td><?= $post->getText() ?></td>
            <td><?= $post->getUser() ?> </td>
            <td><?= $post->getDatePost() ?></td>
        </tr>      
        <?php
    } 
    ?>
    </tbody>
    </table>
    <?php
} ?>
