<?php
    namespace App;

    class Session{

        private static $categories = ['error', 'success'];

        /**
        *   ajoute un message en session, dans la catégorie $categ
        */
        public static function addFlash($categ, $msg){
            $_SESSION[$categ] = $msg;
        }

        /**
        *   renvoie un message de la catégorie $categ, s'il y en a !
        */
        public static function getFlash($categ){
            
            if(isset($_SESSION[$categ])){
                $msg = $_SESSION[$categ];  
                unset($_SESSION[$categ]);
            }
            else $msg = "";
            
            return $msg;
        }

        /**
        *   met un user dans la session (pour le maintenir connecté)
        */
        // permet de stocker un objet User dans la session.
        public static function setUser($user){
            $_SESSION["user"] = $user;
        }
        
        //permet de récupérer l'objet User de la session. Si l'objet existe, il est retourné, sinon la méthode retourne false
        public static function getUser(){
            return (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
        }

        //permet de vérifier si l'utilisateur actuellement connecté a le rôle "admin"
        public static function isAdmin(){
           
            if(self::getUser() && self::getUser()->hasRole("admin")){
                return true;
            }
            return false;
        }

    }