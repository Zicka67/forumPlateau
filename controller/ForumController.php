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

                    // On stock la classe category et topic dans une variable associer
                    $categoryManager = new CategoryManager();
                    $topicManager = new TopicManager();
                    
                    //On return a la vue un tableau data avec l'id de la catégory ciblé 
                    // ( si on clique sur la catégory 2 il va récupérer une class catégory avec les infos de l'id 2 en DB et stock dans category)
                    return [
                        "view" => VIEW_DIR . "forum/listTopicsByIdCategory.php",
                        "data" => [
                            "category" => $categoryManager->findOneById($id),
                            //On cherche les topics dans la catégory de l'id ciblé 
                            // ( exemple id2 : va chercher en DB tt les topics de la category 2 et les stock dans topics)
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
                           // On créer une classe topic et post grace aux managers et de la function construct, pour accéder aux données
                            $topicManager = new TopicManager();
                            $postManager = new PostManager(); 
                            $categoryManager = new CategoryManager();  
                            
                            $category = $categoryManager->findOneById($id);

                            //Si la session du user existe
                            if (isset($_SESSION["user"])) {
                                
                                //VERIFIER SI LE FORM EXISTE QUAND ON APPEL LA FUNCTION
                                if (isset($_POST['modifier'])) {
                                    
                                    $topicTitle = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                    $newMessage = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                    $user = $_SESSION["user"]->getId();

                                    // si les valeurs existent
                                    if ($topicTitle && $newMessage && $user) {
                                    $idTopic = $topicManager->add(["title" => $topicTitle, "category_id" => $category->getId(), "user_id" => $user]);                                 
                                    $postManager->add(["text" => $newMessage, "user_id" => $user, "topic_id" => $idTopic]);
                                        
                                    $this->redirectTo("forum", "listTopicsByIdCategory", $category->getId());
                                   }
                                }
                                return [
                                    "view" => VIEW_DIR . "forum/editTopic.php",
                                    "data" => [
                                        "category" => $categoryManager->findOneById($id),
                                    ],
                                ];
                            }
                        }
                        
                        
                        
                    }
