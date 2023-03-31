<?php
$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];

?>



<h1 class="categoryList">La liste des messages dans le <?= $topic->getTitle() ?></h1>

<?php
if (!$posts) {
    echo "vide pour le moment";
} else { ?>
    <div class="containerPosts">
        <?php

        foreach ($posts as $post) {
            // var_dump($post->getUser());die;
        ?>
      
            <table class="listTable">
                <thead>
                    <tr>
                        <th>Message :</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $post->getText() ?></td>
                    </tr>
                <?php
                     
                ?>
                </tbody>
                <tr class="bottomInfos">
                
                   
                    <th><?= $post->getUser()?></th>
                    <th><?= $post->getDatePost() ?></th>
                </tr>
            </table>
       <?php } ?>
    </div>
<?php

} ?>