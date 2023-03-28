<?php
    namespace Model\Managers;
    //Les class managers gérent les opérations CRUD
    
    use App\Manager;
    use App\DAO;

    class CategoryManager extends Manager{

           //className = nom de votre classe du dossier "entities"
           protected $className = "Model\Entities\Category";
           //nom de la table en base de données
           protected $tableName = "category";

           public function __construct(){
            //parent::connect(); ici parent = app -> DAO et appel la function connect() 
            parent::connect();
        }



    }