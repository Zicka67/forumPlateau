<?php
$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];

?>



<h1 class="categoryList">La liste des messages dans le <?= $topic->getTitle() ?></h1>

<?php
if (!$posts) { ?>
    <div class="centerTopics">Vide pour le moment</div>
<?php } else { ?>
    <div class="containerMain">
        <?php

        foreach ($posts as $post) {
            
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
       <div class="formPostRepondre">
                    <form action="">
                        <label class="postRepondre" for="">Envie de répondre ?
                    <textarea name="" id="" cols="105" rows="6"></textarea>
                    <input type="button" value="Envoyer">
                        </label>
                    </form>
                </div>
    </div>
<?php

} ?>