<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
            $topicManager = new TopicManager();
            // $topicManager->findAll(); //on peut également ajouter une request SQL pour tirer par exemple
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationDate", "DESC"])//on peut également ajouter une request SQL pour tirer par exemple
                ]
            ];
        
        }

        

    }
