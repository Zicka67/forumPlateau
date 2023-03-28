<?php
    namespace App;

    abstract class Manager{

        protected function connect(){
            DAO::connect();
        }

        /**
         * get all the records of a table, sorted by optionnal field and order
         * 
         * @param array $order an array with field and order option
         * @return Collection a collection of objects hydrated by DAO, which are results of the request sent
         */

         //Fonction appelée findAll qui prend un paramètre optionnel $order et renvoie un ensemble de résultats. 
        public function findAll($order = null){

            //Si order est vrai "ORDER BY ".$order[0]. " ".$order[1] SINON vide
            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";

            //Request SQL pour selectionner all de $this->tableName. a comme alias
            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    ".$orderQuery;

            //return le résultat avec 2 arguments : le résultat de select sur la class DAO et $this->tableName
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
       
        //Selectionne une ligne d'une table d'un ID
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

        //$data = ['username' => 'Squalli', 'password' => 'dfsyfshfbzeifbqefbq', 'email' => 'sql@gmail.com'];

        //Ajouter des donnés a un table
        public function add($data){
            //$keys = ['username' , 'password', 'email']
            $keys = array_keys($data);
            //$values = ['Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com']
            $values = array_values($data);
            //"username,password,email"
            $sql = "INSERT INTO ".$this->tableName."
                    (".implode(',', $keys).") 
                    VALUES
                    ('".implode("','",$values)."')";
                    //"'Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com'"
            /*
                INSERT INTO user (username,password,email) VALUES ('Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com') 
            */
            try{
                return DAO::insert($sql);
            }
            catch(\PDOException $e){
                echo $e->getMessage();
                die();
            }
        }
        
        // Supprimer des lignes a partir d'un id
        public function delete($id){
            $sql = "DELETE FROM ".$this->tableName."
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::delete($sql, ['id' => $id]); 
        }

        private function generate($rows, $class){
            foreach($rows as $row){
                yield new $class($row);
            }
        }
        
        // Afficher plusieurs résultats
        protected function getMultipleResults($rows, $class){

            if(is_iterable($rows)){
                return $this->generate($rows, $class);
            }
            else return null;
        }

        // Afficher ou pas un résultat
        protected function getOneOrNullResult($row, $class){

            if($row != null){
                return new $class($row);
            }
            return false;
        }

        // Récupère qu'une seule valeur 
        protected function getSingleScalarResult($row){

            if($row != null){
                $value = array_values($row);
                return $value[0];
            }
            return false;
        }
    
    }