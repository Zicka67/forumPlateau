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
        public function listCategories() {
            
            // Link au Manager
            $categoryManager = new CategoryManager();
            
            
            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["label","ASC"]),
                    ]
                ];  
            }
            
            // Liste topics par categorie
            public function listTopicsByIdCategory($id) {
                
                // Link au Manager
                $categoryManager = new CategoryManager();
                $topicManager = new TopicManager();
                
                
                
                return [
                    "view" => VIEW_DIR."forum/listTopicsByIdCategory.php",
                    "data" => [
                        "category" => $categoryManager->findOneById($id),
                        "topics" => $topicManager->getTopicsByCategory($id),
                        ]
                    ]; 
                }
                
                
                // Liste post par topic
                public function listPostsByIdTopic($id) {
                    
                    // variable qui relie au manager
                    $postManager = new PostManager();
                    $topicManager = new TopicManager();
                    
                    // renvoie 
                    return [
                        "view" => VIEW_DIR."forum/listPostsByIdTopic.php",
                        "data" => [
                            "posts" => $postManager->getPostsByIdTopic($id),
                            "topic" => $topicManager->findOneById($id)
                            ]
                        ];  
                    }
                    
                }                   
                
                
                
                
                
