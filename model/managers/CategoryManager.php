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
    
    //Changer le label ?
    public function editLabel($id, $label) {
        
        // requête SQL
        $sql = "
        UPDATE category
        SET label = :label
        WHERE id_category = :id
        ";
        
        // relie à la fonction déjà faite dans DAO qui update la DB
        DAO::update($sql, ["id"=>$id,"label"=>$label]);
    }
    
    public function addLabel ($label) {
        
        //requête SQL
        $sql = "
        INSERT INTO category(label)
        VALUES (:label)
        ";
        // relie à la fonction déjà faite dans DAO qui update la DB
        DAO::insert($sql, ["label"=>$label]);
    }
    
    public function deleteCategory($id)
    {
        $this->delete($id);
    }

    // public function testDeleteAll($id) {
    //     $this->delete($id);

    //     $sql = "
    //     DELETE FROM post WHERE topic_id IN (SELECT id_topic FROM topic WHERE category_id = :id);
    //     DELETE FROM topic WHERE category_id = :id;
    //     DELETE FROM category WHERE id_category = :id;
    //     ";
    //     // relie à la fonction déjà faite dans DAO qui update la DB
    //     DAO::insert($sql, ["id_category"=>$id]);
    // }
    
}