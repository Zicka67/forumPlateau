<?php
    namespace Model\Managers;
     //Les class managers gérent les opérations CRUD
    
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

        // Liste topics par categorie
        public function getTopicsByCategory($id) {
            parent::connect();
            $sql ="
            SELECT * 
                FROM ".$this->tableName." t
                WHERE t.category_id = :id
                ORDER BY creationDate DESC
            ";
            
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }


    }