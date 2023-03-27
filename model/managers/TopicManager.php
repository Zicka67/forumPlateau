<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\TopicManager;

    //TopicManager hérite de la class Manager
    class TopicManager extends Manager{

        //className = nom de votre classe du dossier "entities"
        protected $className = "Model\Entities\Topic";
        //nom de la table en base de données
        protected $tableName = "topic";


        public function __construct(){
            //parent::connect(); ici parent = app -> DAO et appel la function connect() 
            parent::connect();
        }


    }