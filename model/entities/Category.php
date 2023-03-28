<?php
namespace Model\Entities;

use App\Entity;

final class Category extends Entity{
        
        private $id;
        private $label;
        
        
        public function __construct($data){     
                //hydrate pour remplir les propriétés de l'objet Topic avec les données en DB    
                $this->hydrate($data);        
        }
        
        /**
        * Get the value of id
        */
        public function getId()
        {
                return $this->id;
        }
        
        /**
        * Set the value of id
        */
        public function setId($id): self
        {
                $this->id = $id;
                
                return $this;
        }
        
        /**
        * Get the value of label
        */
        public function getLabel()
        {
                return $this->label;
        }
        
        /**
        * Set the value of label
        */
        public function setLabel($label): self
        {
                $this->label = $label;
                
                return $this;
        }
}
