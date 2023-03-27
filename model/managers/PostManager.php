<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class PostManager extends Manager{

           //className = nom de votre classe du dossier "entities"
           protected $className = "Model\Entities\Post";
           //nom de la table en base de données
           protected $tableName = "post";

           public function __construct(){
            //parent::connect(); ici parent = app -> DAO et appel la function connect() 
            parent::connect();
        }

        public function findPostsByTopic($id) {

            $sql = "SELECT *
                    FROM ".$this->tableName." p
                    WHERE p.topic_id = :id_topic
                    ";

                    //Si plusieurs lignes --> getMultipleResults
                    //Si un seul objet --> getOneOrNullResult
                    return $this->getMultipleResults(
                        DAO::select($sql, ['id' =>$id]),
                        $this->className
                    );
        }

    }