<?php
namespace Model\Managers;
//Les class managers gérent les opérations CRUD

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
    
    public function getPostsByTopic($id) {
        parent::connect();
        $sql = "
        SELECT *
        FROM ".$this->tableName." p
        WHERE p.topic_id = :id
        ORDER BY datePost ASC
        ";
        
        //Si plusieurs lignes --> getMultipleResults
        //Si un seul objet --> getOneOrNullResult
        return $this->getMultipleResults(
            DAO::select($sql, ['id' =>$id]),
            $this->className
        );
    }
    
    // Selectionner post by topic id
    public function getPostsByIdTopic($id) {
        parent::connect();
        $sql ="
        SELECT * 
        FROM ".$this->tableName." p
        WHERE p.topic_id = :id
        ORDER BY datePost ASC
        ";
        
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }
    
    
    
}