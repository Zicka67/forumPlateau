<?php
$posts = $result["data"]['posts'];
$topic = $posts->current()->getTopic();
$countPosts = 0;
// var_dump($posts->current()->getTopic()->getCountPosts());die;

?>


<h1 class="categoryList">La liste des messages dans le
    <?= $topic->getTitle() ?>
</h1>


<?php

if (!$posts) { ?>

    <div class="centerTopics">Vide pour le moment</div>
<?php } else { ?>
    <div class="containerMain">

        <?php
        foreach ($posts as $post) {
            $countPosts++;

            ?>

            <div class="postContainer">

                <table class="listTable">
                    <thead>
                        <tr>
                            <th>Message :</th>
                            <?php if (App\Session::isAdmin()) { ?>
                                <th><a class="supprimerPost"
                                        href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">Supprimer</a></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?= $post->getText() ?>
                            </td>
                        </tr>

                    </tbody>

                    <tr class="bottomInfos">
                        <th class="small">
                            <?= $post->getDatePost() ?>
                        </th>
                        <th class="small">par</th>
                        <th class="small">
                            <?= $post->getUser() ?>
                        </th>
                    </tr>

                </table>
            </div>
            <?php
        } ?>
        <?php
        echo "<p class='test'> Nombre de messages : " . $countPosts . "</p>";
        ?>
        <div class="formPostRepondre">
            <form method="POST" action="index.php?ctrl=forum&action=addPost">
                <label class="postRepondre" for="">Envie de répondre ?
                    <textarea name="message" cols="105" rows="6"></textarea>
                    <!-- hidden input pour stocker l'id de ce topic et l'envoyer dans addPost, surement mieux a faire -->
                    <input type="hidden" name="topic_id" value="<?= $topic->getId() ?>">
                    <input class="buton" type="submit" name="envoyer" value="Envoyer">
                </label>
            </form>
        </div>
    </div>

    <?php
} ?>