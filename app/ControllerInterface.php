<?php

//Le ControllerInterface permet de définir un contract que les autres controleurs doivent respecter en gros.
//Chaque contrôleur peut être appelé de manière uniforme par le routeur de l'application.
//On s'assure que les contrôleurs peuvent être échangés sans risque d'erreur dans les autres parties du code qui les appellent.

    namespace App;

    interface ControllerInterface{

        //cette interface spécifie une méthode index() que chaque contrôleur doit uiliser, 
        // afin de garantir une cohérence et une structure dans la gestion des requêtes utilisateur.
        public function index();
    }