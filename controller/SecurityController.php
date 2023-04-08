<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\DAO;

use Model\Managers\CategorieManager;
use Model\Managers\PostManager;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;

class SecurityController extends AbstractController implements ControllerInterface {
    
    public function index() {
        
    }
    
    //Inscription
    public function addUser()
    {
        
        // Insérer les données dans la DB
        $userManager = new UserManager(); //Relie à la class UserManager
        
        if (isset($_POST['register'])) {
            // Récupérer les données soumises par le formulaire
            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirm_password = $_POST['confirm_password'];
            // $role ?
            
            // Valider les données
            if ($password != $confirm_password) {
                // Afficher une erreur
                die("Les mots de passe ne correspondent pas");
            }
            
            $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Crypter le mot de passe avant de l'insérer
            $user=[
                "pseudo"=>$pseudo,
                "email"=>$email,
                "password"=>$passwordHash,
                "role"=>"user",
            ];
            // execution de la fonction pré-implémenté add($data)
            $result = $userManager->add($user); 
            if (!$result) {
                die("Une erreur s'est produite lors de l'ajout de l'utilisateur.");
            }
            // Session::addFlash('success', 'vous êtes bien enregistré !');
            
            // redirige vers la page d'accueil
            $this->redirectTo('home');  
            
            // Rediriger l'utilisateur vers la page de connexion
            header("Location: login.php");
            
        }
        return ["view" => VIEW_DIR. "security/register.php"];
    }
    
    //Se connecter 
    public function login() {
        
        //Crée une nouvelle instance de la class UserManager, qui est responsable de la gestion des user
        $userManager = new UserManager();
        
        // Si connect est non null if(isset($_POST['login'])) { ne fonctionne pas ! if (!empty($_POST) && isset($_POST['login'])) { testé et ne fonctionne pas non plus 
            // Vérifie s'il y a des données POST envoyées au script (soumission de formulaire)
            if(isset($_POST)) {
                //Récupère le mail soumis à partir des données POST, en le filtrant
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                
                //Récupère le password soumis à partir des données POST, en le filtrant
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // Vérifie si le mail + password existent après les filtres
                if($email && $password) {
                    
                    // Récupère le password d'un user dans la base de données à l'aide de son email
                    $recupPassword = $userManager->findOneByEmail($email)->getPassword();
                    
                    //Vérifie si un user avec le mail donnée existe 
                    if($recupPassword) {
                        
                        // Récupère le pawword haché de l'utilisateur 
                        $hashPassword = $recupPassword;
                        // var_dump($hashPassword);die;
                        // On utilise findOneByEmail() de la class UserManager pour trouver le user correspondant 
                        // au mail (en argument) saisie par le user. Le user est stocké dans la variable $user
                        $user = $userManager->findOneByEmail($email);
                        
                        //Vérifie si le mot de passe de l'user = a celui en DB, si oui on continue 
                        
                        if (password_verify($password, $hashPassword)) {
                            
                            // vérifie si le user est autorisé à se connecter en utilisant la méthode getStatus() de la classe User
                            // Si l'utilisateur est autorisé, le code à l'intérieur de la condition est exécuté
                            if ($user->getStatus()) {
                                //Enregistre le user dans la session en utilisant la méthode setUser() de la classe Session
                                Session::setUser($user);                              
                                
                                // Ajoute un message de succès à la session en utilisant la méthode addFlash() de la classe Session
                                Session::addFlash("success", "Login successfully");
                                return [
                                    "view" => VIEW_DIR . "home.php",
                                    "data" => [
                                        "user" => $user,
                                        ]
                                    ];
                                } else {
                                    Session::addFlash('error', "You're banned !");
                                    $this->redirectTo("security", "login");
                                }
                            } else {
                                Session::addFlash('error', "Password problem");
                                $this->redirectTo("security", "login");
                            }
                        } else {
                            Session::addFlash('error', "incorrect password");
                            $this->redirectTo("security", "login");
                        }    
                    }
                    return ["view" => VIEW_DIR . "security/login.php"];
                }
                
            }
            
            // FONCTION QUI DECONNECTE
            public function logout() {
                
                if (isset($_SESSION['user'])) {
                    // remplace la session de l'user par une session vide
                    $_SESSION['user'] = null;
                    //message qui affirme la déconnexion
                    Session::addFlash('success', 'Vous êtes bien déconnecté');
                    // retourne sur la page d'accueil
                    return ["view" => VIEW_DIR . "home.php"];
                }
            }
            
            // FONCTION AFFICHAGE PROFIL 
            public function profil() {
                
            }
            
            // FONCTION AFFICHAGE LISTE UTILISATEUR (ADMIN)
            public function listUsers()
            {
                // Link au Manager
                $userManager = new UserManager();
                
                // Récupération de tous les utilisateurs
                $users = $userManager->findAll();
                
                // Retourne la vue et les données
                return [
                    "view" => VIEW_DIR . "security/listUsers.php",
                    "data" => [
                        "users" => $users,
                    ],
                ];
            }
            
            public function banUser()
            {
                if (!isset($_POST['id'])) {
                    // Si aucun ID n'a été envoyé, redirection vers la page de liste des utilisateurs
                    $this->redirectTo('security', 'listUsers');
                }
                //On stock la valeur de id dans uen variable ( ici $id = a l'utilisateur id=12 )
                $id = $_POST['id'];
                
                // Vérifie si l'utilisateur en session est un administrateur
                // var_dump($id); die;     id=12
                if ($_SESSION['user']->getRole() == 'admin') {
                    $userManager = new UserManager();
                    // Récupère le pseudo de l'utilisateur à bannir
                    $userPseudo = $userManager->findOneById($id)->getPseudo();
                    // var_dump($userPseudo); die;    pseudo = test
                    // Bannit l'utilisateur en mettant à jour le champ "status" dans la base de données
                    $userManager->banUserById($id);
                    // var_dump($id); die;    id=12
                    
                    // Affiche un message de succès
                    $message = "L'utilisateur ".$userPseudo." a été banni";
                    // Redirige vers la page de liste des utilisateurs
                    Session::addFlash('success', $message);
                    
                    // Redirige vers la page de liste des utilisateurs
                    $this->redirectTo('security', 'listUsers');
                } else {
                    // Si l'utilisateur n'est pas un administrateur, affiche un message d'erreur
                    $message = "Vous n'êtes pas autorisé à effectuer cette action";
                    $this->redirectTo('security', 'listUsers', ['message' => $message]);
                }
            }
            
            
            public function UnBanUser(){
                if (!isset($_POST['id'])) {
                    // Si aucun ID n'a été envoyé, redirection vers la page de liste des utilisateurs
                    $this->redirectTo('security', 'listUsers');
                }
                
                $id = $_POST['id'];
                
                if ($_SESSION['user']->getRole() == 'admin') {
                    $userManager = new UserManager();
                    
                    $userPseudo = $userManager->findOneById($id)->getPseudo();
                    
                    $userManager->UnBanUserById($id);
                    
                    // Affiche un message de succès
                    $message = "L'utilisateur ".$userPseudo." a été unBann";
                    // Redirige vers la page de liste des utilisateurs
                    Session::addFlash('success', $message);
                    $this->redirectTo('security', 'listUsers');
                } else {
                    // Si l'utilisateur n'est pas un administrateur, affiche un message d'erreur
                    $message = "Vous n'êtes pas autorisé à effectuer cette action";
                    $this->redirectTo('security', 'listUsers', ['message' => $message]);
                }
                
            }
            
            public function showProfile()
            {
                // Vérifie si l'utilisateur est connecté
                if (isset($_SESSION["user"])) {
                    $userManager = new UserManager();
                    // Récupère l'utilisateur connecté
                    $user = $_SESSION["user"];
                    $user->setLastPost($userManager->getLastPost($user->getId()));
                    $user->setCountPost($userManager->countPost($user->getId()));
                    
                    // var_dump($user); die;
                    // Charge la vue profile.php en passant les informations de l'utilisateur
                    require_once("view/security/profile.php");
                } else {
                    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
                    $this->redirectTo('security', 'login');
                }
            }

            
        }
        
        
        
        