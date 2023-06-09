<?php
namespace Model\Entities;

use App\Entity;

final class Topic extends Entity{
        
        private $id;
        private $title;
        private $creationDate;
        private $category;
        private $user;
        private $closed;
        private $countPosts;
        
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
        *
        * @return  self
        */ 
        public function setId($id)
        {
                $this->id = $id;
                
                return $this;
        }
        
        /**
        * Get the value of title
        */ 
        public function getTitle()
        {
                return $this->title;
        }
        
        /**
        * Set the value of title
        *
        * @return  self
        */ 
        public function setTitle($title)
        {
                $this->title = $title;
                
                return $this;
        }
        
        /**
        * Get the value of user
        */ 
        public function getUser()
        {
                return $this->user;
        }
        
        /**
        * Set the value of user
        *
        * @return  self
        */ 
        public function setUser($user)
        {
                $this->user = $user;
                
                return $this;
        }
        
        public function getCreationDate(){
                $formattedDate = $this->creationDate->format("d/m/Y, H:i:s");
                return $formattedDate;
        }
        
        public function setCreationDate($date){
                $this->creationDate = new \DateTime($date);
                return $this;
        }
        
        /**
        * Get the value of closed
        */ 
        public function getClosed()
        {
                return $this->closed;
        }
        
        /**
        * Set the value of closed
        *
        * @return  self
        */ 
        public function setClosed($closed)
        {
                $this->closed = $closed;
                
                return $this;
        }
        
        public function isClosed()
        {
                return $this->closed == 1;
        }
        
        /**
        * Get the value of category
        */
        public function getCategory()
        {
                return $this->category;
        }
        
        /**
        * Set the value of category
        */
        public function setCategory($category): self
        {
                $this->category = $category;
                
                return $this;
        }
        
        /**
        * Get the value of countPosts
        */ 
        public function getCountPosts()
        {
                return $this->countPosts;
        }
        
        /**
        * Set the value of countPosts
        *
        * @return  self
        */ 
        public function setCountPosts($countPosts)
        {
                $this->countPosts = $countPosts;
                
                return $this;
        }
}
