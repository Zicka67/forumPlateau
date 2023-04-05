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
            
            $topic = $topicManager->findOneById($id);
            // var_dump($topic); die;
            // renvoie 
            
            return [
                "view" => VIEW_DIR . "forum/listPostsByIdTopic.php",
                "data" => [
                    "posts" => $postManager->getPostsByTopic($id),
                    "topic" => $topic,
                    
                    ]
                ];
                
            }
            public function addPost()
            {
                if (isset($_SESSION["user"]) && isset($_POST['envoyer'])) {
                    $postManager = new PostManager();
                    $userManager = new UserManager();
                    
                    $newPost = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $user_id = $_SESSION["user"]->getId();
                    $topic_id = filter_input(INPUT_POST, "topic_id", FILTER_SANITIZE_NUMBER_INT);
                    
                    
                    if ($newPost && $user_id && $topic_id) {
                        $postManager->add([
                            "text" => $newPost,
                            "user_id" => $user_id,
                            "topic_id" => $topic_id,
                        ]);
                        // var_dump($topic_id); die; 
                        // redirection vers la même page
                        $this->redirectTo("forum", "listPostsByIdTopic", $topic_id);
                    }
                }
            }
            
            public function deletePost()
            {
                // Vérifie que l'utilisateur est connecté et qu'il est admin
                $user = Session::getUser();
                if (!$user || !$user->hasRole('admin')) {
                    // Redirige vers une page d'erreur ou de connexion
                    $this->redirectTo("forum", "listTopicsByIdCategory");
                }
                
                // Récupére l'ID du topic à supprimer depuis les paramètres GET
                $postId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
                // var_dump($postId); die;
                
                // Créer un objet de postManager et appele la fonction postTopic
                $postManager = new PostManager();
                $topicManager = new TopicManager();
                $topic = $postManager->findOneById($postId)->getTopic();
                $countPosts = count(iterator_to_array($postManager->getPostsByTopic($topic->getId())));                
                if ($countPosts == 1) {
                    // Supprime le topic si c'est le dernier post
                    $postManager->delete($postId);
                    $topicManager->deleteTopic($topic->getId());
                    // Redirige vers la liste des topic associés à la catégorie
                    $this->redirectTo("forum", "listTopicsByIdCategory", $topic->getCategory()->getId());
                } else {
                    // Supprime le message
                    $postManager->delete($postId);
                    // Redirige vers la liste des messages associés à ce sujet
                    $this->redirectTo("forum", "listPostsByIdTopic", $topic->getId());
                }
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
                
                public function deleteCategory()
                {
                    
                    // Vérifie que l'utilisateur est connecté et qu'il est admin
                    $user = Session::getUser();
                    if (!$user || !$user->hasRole('admin')) {
                        // Redirige vers une page d'erreur ou de connexion
                        $this->redirectTo("forum", "listCategories");
                    }
                    
                    // Récupére l'ID de la catégorie à supprimer depuis les paramètres GET
                    $categoryId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
                    // var_dump($categoryId); die ;
                    // Créer un objet de CategoryManager et appele la fonction deleteCategory
                    $categoryManager = new CategoryManager();
                    $categoryManager->deleteCategory($categoryId);
                    
                    // Redirige vers la liste des catégory
                    $this->redirectTo("forum", "listCategories");
                }
                
                // ************************ TOPIC ******************************
                
                // Liste topics par categorie
                public function listTopicsByIdCategory($id)
                {
                    
                    // On stock la classe category et topic dans une variable associer
                    $categoryManager = new CategoryManager();
                    $topicManager = new TopicManager();
                    
                    $category = $categoryManager->findOneById($id);
                    
                    // Si la catégorie est introuvable, créez un objet Category par défaut avec un label "Introuvable"
                    if (!$category) {
                        $category = new \Model\Entities\Category(["label" => "Introuvable"]);
                    }
                    //On return a la vue un tableau data avec l'id de la catégory ciblé 
                    // ( si on clique sur la catégory 2 il va récupérer une class catégory avec les infos de l'id 2 en DB et stock dans category)
                    return [
                        "view" => VIEW_DIR . "forum/listTopicsByIdCategory.php",
                        "data" => [
                            "category" => $category,
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
                                "view" => VIEW_DIR . "forum/addTopic.php",
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
                        
                        public function deleteTopic()
                        {
                            
                            // Vérifie que l'utilisateur est connecté et qu'il est admin
                            $user = Session::getUser();
                            if (!$user || !$user->hasRole('admin')) {
                                // Redirige vers une page d'erreur ou de connexion
                                $this->redirectTo("forum", "listTopicsByIdCategory");
                            }
                            
                            // Récupére l'ID du topic à supprimer depuis les paramètres GET
                            $topicId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
                            // var_dump($categoryId); die ;
                            // Créer un objet de topicManager et appele la fonction deleteTopic
                            $topicManager = new TopicManager();
                            $topicManager->deleteTopic($topicId);
                            
                            // Redirige vers la liste des catégory
                            $this->redirectTo("forum", "listTopicsByIdCategory");
                        }
                        
                        
                        // *****************LOCK UNLOCK **************
                        
                        public function closeTopic($topicId) {
                            // var_dump($topicId); die;  works
                            $topicManager = new TopicManager();
                            $userManager = new UserManager();
                            
                            $topic = $topicManager->findOneById($topicId);
                            
                            // On recheck le role du user connecté dans la DB et non à partir du $_SESSION (pour si changement role en cours de session)
                            $userConnectedDb = $userManager->findOneById($_SESSION["user"]->getId())->getRole();
                            
                            // Check si user = admin ou le créateur du topic avec l'id
                            if(!empty($_SESSION["user"])) {
                                if(($userConnectedDb == "ROLE_ADMIN") || ($_SESSION["user"]->getId() == $topic->getUser()->getId())) {
                                    
                                    // Switch closed (fermeture/reouverture)
                                    if($topic->getClosed() == "1") {
                                        $topicManager->lockTopicById($topicId, "0");
                                        $_SESSION["success"] = "Le topic a été fermé";
                                    }
                                    else {
                                        $topicManager->unlockTopicById($topicId, "1");
                                        $_SESSION["success"] = "Le topic a été rouvert";
                                    }
                                    // var_dump($topic); die;
                                    $category_id = $topic->getCategory()->getId();
                                    header("Location: index.php?ctrl=forum&action=listTopicsByIdCategory&id=".$category_id);
                                    // $this->redirectTo("forum", "listTopicsByIdCategory", ["id" => $category_id]);
                                }
                                else {
                                    $_SESSION["error"] = "Vous devez être admin ou l'auteur de se topic";
                                    $category_id = $topic->getCategory()->getId();
                                    header("Location: index.php?ctrl=forum&action=listTopicsByIdCategory&id=".$category_id);
                                    // $this->redirectTo("forum", "listTopicsByIdCategory", $topicId);
                                }
                                
                            }
                            
                            
                        }
                        
                        
                        
                        
                        
                    }