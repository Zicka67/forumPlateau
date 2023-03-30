<?php
    // Déclaration de l'espace de noms
    namespace App;

    abstract class AbstractController{

        public function index(){}
        
        // public function redirectTo($ctrl = null, $action = null, $id = null){

        //     //Si le controller n'est pas home
        //     if($ctrl != "home"){
        //         //correction conv forum teams à vérifier pk
        //         $url = "index.php"; // Initialisation de la variable "$url" avec la valeur "index.php"
        //         //"?" ternaire
        //         $url = $ctrl ? "?ctrl=".$ctrl : ""; // Si "ctrl" est défini, concaténer "/<ctrl>" à "$url", sinon laisser "$url" inchangé
        //         $url.= $action ? "&action=".$action : ""; // Si "action" est défini, concaténer "?action=<action>" à "$url", sinon laisser "$url" inchangé
        //         $url.= $id ? "&id".$id : ""; // Si "id" est défini, concaténer "&id=<id>" à "$url", sinon laisser "$url" inchangé
        //     }
        //     else $url = "/";// Si "ctrl" est égal à "home", initialiser "$url" avec la valeur "/"
        //     header("Location: $url"); //Rediriger l'utilisateur vers l'URL spécifiée dans "$url"
        //     die();

        // }

        public function redirectTo($ctrl = null, $action = null, $id = null){

            // Initialisation de la variable "$url" avec la valeur "index.php"
            $url = "index.php";
        
            // Si ctrl est défini, l'ajoute à l'URL en tant que paramètre de requête
            if ($ctrl) {
                $url .= "?ctrl=" . $ctrl;
            }
            //Si action est défini, L'ajoute à l'URL en tant que paramètre de requête
            // Utilise "&" si "ctrl" est également défini, sinon utilise "?" ternaire
            if ($action) {
                $url .= ($ctrl ? "&" : "?") . "action=" . $action;
            }
            // Si "id" est défini, l'ajoute à l'URL en tant que paramètre de requête
            if ($id) {
                $url .= "&id=" . $id;
            }
        
            header("Location: $url"); //Redirige l'utilisateur vers l'URL spécifiée dans "$url"
            die();
        }

        public function restrictTo($role){
            
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){ // Si l'utilisateur n'est pas connecté ou n'a pas le rôle spécifié dans "$role"
                $this->redirectTo("security", "login");// Alors on redirige l'utilisateur vers la page de connexion
            }
            return;
        }

    }