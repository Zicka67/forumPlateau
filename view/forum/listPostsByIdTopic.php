<?php
$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];
// var_dump($topic); die;
$countPosts = 0;
// var_dump($posts->current()->getTopic()->getCountPosts());die;

?>


<h1 class="postList">La liste des messages dans le <?= $topic->getTitle() ?></h1>

<?php
if (!$posts) { ?>

    <div class="centerTopics">Vide pour le moment</div>
<?php } else { ?>
    <div class="containerMain">
    
        <?php
        foreach ($posts as $post) {
            $countPosts++;
        ?>
            <div class="postContainer" >
            <table class="listTable">
                <thead>
                    <tr>
                    <?php if (App\Session::isAdmin()) { ?> 
                        <th>Message : </th>                   
                        <?php } ?>         
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
                    <th class="small">par <?= ucfirst($post->getUser())?> le <?= $post->getDatePost() ?></th>
                </tr>
            </table>
            <div class="supprimerPost">
            <a  href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">Supprimer</a>
            </div>
               <?php } ?>  
            </div>
       <?php } ?>  <?php echo "<p class='absolute'>Nombre de messages : " . $countPosts . "</p>"?> <?php ; ?>
       
       <div class="formPostRepondre">
        <!-- Condition pour cacher le formulaire si le topic est closed ( = 0) -->
        <?php if($topic->getClosed()) { ?>
                    <form method="POST" action="index.php?ctrl=forum&action=addPost">

                    <div class="postRepondre" for="">Envie de répondre ?
                    </div>

                    <div>
                        <textarea class="postTextarea" name="message" cols="134" rows="4"></textarea>
                        <!-- hidden input pour stocker l'id de ce topic et l'envoyer dans addPost, surement mieux a faire -->
                        <input type="hidden" name="topic_id" value="<?= $topic->getId() ?>"> 
                        <input class="buton0" type="submit" name="envoyer" value="Envoyer">
                    </div>
                    </form>
     <?php } ?>
        </div>
    </div>
    </div>
<?php


