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
            
            // Insérer les données dans la DB
            $userManager = new UserManager(); //Relie à la class UserManager

            $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Crypter le mot de passe avant de l'insérer
            $user=[
                "pseudo"=>$pseudo,
                "email"=>$email,
                "password"=>$passwordHash,
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
    //    echo "dqdqz"; die;
       
        // Si connect est non null
        if(isset($_POST['login'])) {
            
            //On filtre
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            //On filtre pas le password ( je pense )
            $password = $_POST["password"];
            
            // si c'est ca existe
            if($email) {
                if($password) {
                    // Link au userManager
                    $userManager = new UserManager();
                  
                    // a corriger, passer par finonebyemail par directement par le manager
                    $getPassword = $userManager->findOneByEmail($email)->getPassword($email);
                    die;
                    // relier a l'user
                    $getUser = $userManager->findOneByEmail($email);

                    // si il y a un utilisateur
                    if($getUser) {
                        // comparaison (hashage) du mot de passe de la DB et celui du formulaire
                        $checkPassword = password_verify($password, $getPassword['password']);
    
                        // si le pass est bon
                        if($checkPassword){
                            // connection à la session de l'utilisateur
                            Session::setUser($getUser);
                            Session::addFlash('success', 'Bienvenue');
                            $this->redirectTo('home');
                        } //message si erreur mot de pass
                        
                    }//message si erreur user, pas de compte lié
                }//message si erreur mot de pass
            }//message si erreur email, mail sans compte
          
        }
          // renvoie à la page de connexion si le formulaire est vide
          return ["view" => VIEW_DIR . "security/login.php"];
    }
}
