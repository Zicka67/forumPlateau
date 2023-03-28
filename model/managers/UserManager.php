<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class UserManager extends Manager{

           //className = nom de votre classe du dossier "entities"
           protected $className = "Model\Entities\User";
           //nom de la table en base de données
           protected $tableName = "user";

           public function __construct(){
            //parent::connect(); ici parent = app -> DAO et appel la function connect() 
            parent::connect();
        }

        public function findOneByEmail($email) {

            $sql = "SELECT *
                    FROM ".$this->tableName." p
                    WHERE p.email_id = :id_email
                    ";

                    //Si plusieurs lignes --> getMultipleResults
                    //Si un seul objet --> getOneOrNullResult
                    return $this->getOneOrNullResult(
                        DAO::select($sql, ['email' =>$email, false]),
                        $this->className
                    );
        }

    }