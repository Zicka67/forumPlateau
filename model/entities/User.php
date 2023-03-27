<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $pseudo;
        private $password;
        private $dateCreate;
        private $email;
        private $role;

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
         * Get the value of pseudo
         */
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         */
        public function setPseudo($pseudo): self
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        /**
         * Get the value of password
         */
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         */
        public function setPassword($password): self
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of dateCreate
         */
        public function getDateCreate()
        {
                return $this->dateCreate;
        }

        /**
         * Set the value of dateCreate
         */
        public function setDateCreate($dateCreate): self
        {
                $this->dateCreate = $dateCreate;

                return $this;
        }

        /**
         * Get the value of email
         */
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         */
        public function setEmail($email): self
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of role
         */
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         */
        public function setRole($role): self
        {
                $this->role = $role;

                return $this;
        }
    }
