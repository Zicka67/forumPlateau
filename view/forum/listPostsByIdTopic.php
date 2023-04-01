<?php
$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];

?>



<h1 class="categoryList">La liste des messages dans le <?= $topic->getTitle() ?></h1>

<?php
if (!$posts) {
    echo "vide pour le moment";
} else { ?>
    <div class="containerMain">
        <?php

        foreach ($posts as $post) {
            // var_dump($post);die;
        ?>
            <div class="postContainer" >
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
                    <th class="small"><?= $post->getDatePost() ?></th>
                    <th class="small">par</th>
                    <th class="small"><?= $post->getUser()?></th>
                </tr>
            </table>
            </div>
       <?php } ?>
    </div>
<?php

} ?>