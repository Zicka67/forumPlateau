<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;

use Model\Managers\TopicManager;
use Model\Managers\CategoryManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        $topicManager = new TopicManager();
        // $topicManager->findAll(); //on peut également ajouter une request SQL pour tirer par exemple

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findAll(["creationDate", "DESC"]) //on peut également ajouter une request SQL pour tirer par exemple
            ]
        ];
    }

    // Liste Categorie
    public function listCategories()
    {

        // Link au Manager
        $categoryManager = new CategoryManager();


        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
            "data" => [
                "categories" => $categoryManager->findAll(["label", "ASC"]),
            ]
        ];
    }

    // Liste topics par categorie
    public function listTopicsByIdCategory($id)
    {

        // Link au Manager
        $categoryManager = new CategoryManager();
        $topicManager = new TopicManager();



        return [
            "view" => VIEW_DIR . "forum/listTopicsByIdCategory.php",
            "data" => [
                "category" => $categoryManager->findOneById($id),
                "topics" => $topicManager->getTopicsByCategory($id),
            ]
        ];
    }


    // Liste post par topic
    public function listPostsByIdTopic($id)
    {

        // variable qui relie au manager
        $postManager = new PostManager();
        $topicManager = new TopicManager();

        // renvoie 
        return [
            "view" => VIEW_DIR . "forum/listPostsByIdTopic.php",
            "data" => [
                "posts" => $postManager->getPostsByIdTopic($id),
                "topic" => $topicManager->findOneById($id)
            ]
        ];
    }

    // AJOUT D'UN LABEL
    public function addCategory()
    {
        //VERIFIER SI LE FORM EXISTE QUAND ON APPEL LA FUNCTION
        if (isset($_POST['modifier'])) {
            $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           

            $categoryManager = new CategoryManager();

            // si les valeurs existent
            if ($label) {

                $newLabel = ["label" => $label];
                $categoryManager->add($newLabel);
                // on redirige
                $this->redirectTo("forum", "listCategories");
            }
        }
        return [
            "view" => VIEW_DIR . "forum/editCategory.php",
            
        ];
    }

    public function addTopic()
    {
        //VERIFIER SI LE FORM EXISTE QUAND ON APPEL LA FUNCTION
        if (isset($_POST['modifier'])) {
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           

            $categoryManager = new CategoryManager();

            // si les valeurs existent
            if ($title) {

                $newTitle = ["title" => $title];
                $categoryManager->add($newTitle);
                // Redirige après que la function s'est bien executée
                $this->redirectTo("forum", "listTopics");
            }
        }
        return [//Redirige au clic sur Edit un topic
            "view" => VIEW_DIR . "forum/editTopic.php",
            
        ];
    }
    // AJOUT D'UN TOPIC
    public function addTopicTEST($id)
    {

        if (isset($_POST['modifier'])) {
        // filtres pour la sécurité du formulaire
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // renvoi à un user ?

        $userId = 1;
        //variable qui relie au manager TOPIC
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        // si les valeurs existent
        if ($title && $text) {
            // $data déclarée pour être utilisée dans la fonction add($data) dans manager
            $newTopic = ["title" => $title, "category_id" => $id, "user_id" => $userId];
            // prend une fonction auto-intégré "lastinsertid"
            $topicId = $topicManager->add($newTopic);

            $newPost = ["text" => $text, "topic_id" => $topicId, "user_id" => $userId];
            $postManager->add($newPost);

            $this->redirectTo("forum", "listTopicsByIdCategory", $id);
        }
    }
}
}
