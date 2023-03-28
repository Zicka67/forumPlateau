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
    
    public function addUser()
    {
        if (isset($_POST['register'])) {
            // Récupérer les données soumises par le formulaire
            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirm_password = $_POST['confirm_password'];
            
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
            Session::addFlash('success', 'vous êtes bien enregistré !');
            // redirige vers la page d'accueil
            $this->redirectTo('home');  
            
            // $user->pseudo = $pseudo;
            // $user->email = $email;
            // $user->password = password_hash($password, PASSWORD_DEFAULT); // Crypter le mot de passe avant de l'insérer
            // $user->save();
            
            // Rediriger l'utilisateur vers la page de connexion
            header("Location: login.php");
        }
        
    }
    
}