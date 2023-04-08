<?php
namespace Model\Managers;
//Les class managers gérent les opérations CRUD

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
    
     //Trouver un user par son mail id
    public function findOneByEmail($email) {
        
        //On stock la requete dans une var $sql
        $sql = "SELECT *
        FROM ".$this->tableName." a
        WHERE a.email = :email
        ";
        
        //Si plusieurs lignes --> getMultipleResults
        //Si un seul objet --> getOneOrNullResult
        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false), 
            $this->className
        );
    }

    public function findOneById($id){

        $sql = "SELECT *
                FROM ".$this->tableName." a
                WHERE a.id_".$this->tableName." = :id
                ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false), 
            $this->className
        );
    }
// **************** A TESTER 
      //Trouver un user par son mdp id
      public function findOneByPassword($password) {
        
        $sql = "SELECT *
        FROM ".$this->tableName." p
        WHERE p.password = :password
        ";
        
        //Si plusieurs lignes --> getMultipleResults
        //Si un seul objet --> getOneOrNullResult
        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' =>$password]),
            $this->className
        );
    }

    //Trouver un user par son pseudo id
    public function findOneByPseudo($pseudo) {
        
        $sql = "SELECT *
        FROM ".$this->tableName." p
        WHERE p.pseudo_id = :id_pseudo
        ";
        //WHERE p.pseudo = :pseudo ?
        
        //Si plusieurs lignes --> getMultipleResults
        //Si un seul objet --> getOneOrNullResult
        return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' =>$pseudo, false]),
            $this->className
        );
    }
    
    //Avoir l'email de l'user -> pour verification plus tard
    public function checkEmail($email){
        $sql = "
        SELECT email 
        FROM user 
        WHERE email = :email
        ";
        return(DAO::select($sql,['email' => $email]));
    }

    public function banUserById($id) {
        $sql = "UPDATE ".$this->tableName." 
        SET status = 0 
        WHERE id_user  = :id";
        DAO::update($sql, ['id' => $id]);
    }

    public function UnBanUserById($id) {
        $sql = "UPDATE ".$this->tableName." 
        SET status = 1 
        WHERE id_user  = :id";
        DAO::update($sql, ['id' => $id]);
    }

    public function getLastPost($id) :array {
        $sql = "SELECT *
        FROM post
        WHERE user_id = :id
        ORDER BY datePost DESC
        LIMIT 1";
        $lastPost =  DAO::select($sql, ['id'=> $id]);
        return $lastPost != null ? $lastPost[0] : null;
    }

    //coalesce(count(id_post),0) retun 0 si aucune donnée trouvée 
    public function countPost ($id) {
        
        $sql = " SELECT coalesce(count(id_post),0) AS nbPost    
        FROM post
        WHERE user_id = :id
        ";
        $countPost = DAO::select($sql, ["id"=> $id]);
        return $countPost[0]["nbPost"];
    }
     
}