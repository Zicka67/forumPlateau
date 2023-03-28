<?php
namespace Model\Entities;

use App\Entity;

//final pour les classes empêche l'héritage
final class Post extends Entity{
        
        private $id;
        private $text;
        private $datePost;
        private $user;
        private $topic;
        
        public function __construct($data){     
                //hydrate permet "d'alimenter" des attributs avec des valeurs. Cette function a un tab associatif ($data) comme argument
                $this->hydrate($data);        
        }
        
        public function getDatePost(){
                $formattedDate = $this->datePost->format("d/m/Y, H:i:s");
                return $formattedDate;
        }
        
        public function setDatePost($date){
                $this->datePost = new \DateTime($date);
                return $this;
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
        * Get the value of text
        */
        public function getText()
        {
                return $this->text;
        }
        
        /**
        * Set the value of text
        */
        public function setText($text): self
        {
                $this->text = $text;
                
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
        */
        public function setUser($user): self
        {
                $this->user = $user;
                
                return $this;
        }
        
        /**
        * Get the value of topic
        */
        public function getTopic()
        {
                return $this->topic;
        }
        
        /**
        * Set the value of topic
        */
        public function setTopic($topic): self
        {
                $this->topic = $topic;
                
                return $this;
        }
}
