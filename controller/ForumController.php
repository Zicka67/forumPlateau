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
        
        // ************************** POST ****************************
        
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
                    "topic" => $topicManager->findOneById($id),
                    ]
                ];
                
            }
            
            //************************** CATEGORIE *************************** 
            
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
                
                
                // AJOUT D'UN LABEL
                public function addCategory()
                {
                    $categoryManager = new CategoryManager();
                    
                    //VERIFIER SI LE FORM EXISTE QUAND ON APPEL LA FUNCTION
                    if (isset($_POST['modifier'])) {
                        $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_FULL_SPECIAL_CHARS);                  
                        
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
                
                // ************************ TOPIC ******************************
                
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
                    
                    //Redirection vers addTopic
                    public function redirectToAddTopic($id)
                    {
                        if (isset($_SESSION['user'])) {
                            $categoryManager = new CategoryManager();
                            return [
                                "view"=> VIEW_DIR . "forum/addTopic.php",
                                "data" => [
                                    "category" => $categoryManager->findOneById($id)
                                    ]
                                ];
                            }
                        }
                        
                        //$id est = a l'id de la catégorie ici pour lui ajouter a lui un topic
                        public function addTopic($id)
                        {
                            // var_dump($id); die;
                            $topicManager = new TopicManager();
                            $postManager = new PostManager();
                            
                            //Si la session du user existe
                            if (isset($_SESSION["user"])) {
                                
                                //VERIFIER SI LE FORM EXISTE QUAND ON APPEL LA FUNCTION
                                if (isset($_POST['modifier'])) {
                                    $topicTitle = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                    $newMessage = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                    $user = $_SESSION["user"]->getId();
                                    $close = 1;
                                    
                                    // si les valeurs existent
                                    if ($topicTitle && $newMessage && $user) {
                                        
                                        //On rempalce en BDD
                                        $newTitle = ["title" => $topicTitle, "category_id" => $id, "user_id" => $user, "closed" => $close];
                                        $newMessage = ["message" => $newMessage, "user_id" => $user, "topic_id" => $newTitle];
                                        // var_dump($id); die;
                                        // Redirige après que la function s'est bien executée
                                        $this->redirectTo("forum", "listTopics", $newTitle);
                                    }
                                }
                                return [//Redirige au clic sur Edit un topic
                                    "view" => VIEW_DIR . "forum/editTopic.php",
                                    
                                ];
                            }
                        }
                        
                        
                        
                    }
