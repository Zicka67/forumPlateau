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
            "view" => VIEW_DIR."forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findAll(["creationDate", "DESC"])//on peut également ajouter une request SQL pour tirer par exemple
                ]
            ];
            
    }
        
        // Liste Categorie
        public function listCategory() {
            
            // Link au Manager
            $categoryManager = new CategoryManager();
            
            
            return [
                "view" => VIEW_DIR."forum/listCategory.php",
                "data" => [
                    "category" => $categoryManager->findAll(["label","ASC"]),
                    ]
                ];  
    }
            
        // Liste topics par categorie
        public function listTopicsByCategory() {
                
                // Link au Manager
                $categoryManager = new CategoryManager();
                $topicManager = new TopicManager();

                
                
                return [
                    "view" => VIEW_DIR."forum/listTopicsByCategory.php",
                    "data" => [
                        "category" => $categoryManager->findAll(["label","ASC"]),
                        "topic" => $topicManager->findAll(["title","ASC"]),
                        ]
                    ];  
    }

                
}
    
    
