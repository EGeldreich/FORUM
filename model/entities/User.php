<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity{

    private $id;
    private $nickname;
    private $password;
    private $mail;
    private $role;
    private $registrationDate;

    private $totalTopicsPosts;  // champs non mappé
    private $totalPosts;
    private $totalTopics; 

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }
    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }


    /**
     * Get the value of nickname
     */ 
    public function getNickname(){
        return $this->nickname;
    }
    /**
     * Set the value of nickname
     *
     * @return  self
     */ 
    public function setNickname($nickname){
        $this->nickname = $nickname;
        return $this;
    }


    /**
     * Get the value of password
     */ 
    public function getPassword(){
        return $this->password;
    }
    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }


    /**
     * Get the value of mail
     */ 
    public function getMail(){
        return $this->mail;
    }
    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail){
        $this->mail = $mail;
        return $this;
    }


    /**
     * Get the value of role
     */ 
    public function getRole(){
        return $this->role;
    }
    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role){
        $this->role = $role;
        return $this;
    }


    /**
     * Get the value of registrationDate
     */ 
    public function getRegistrationDate(){
        return $this->registrationDate;
    }
    /**
     * Set the value of registrationDate
     *
     * @return  self
     */ 
    public function setRegistrationDate($registrationDate){
        $this->registrationDate = $registrationDate;
        return $this;
    }


    /**
     * Get the value of totalTopicsPosts
     */ 
    public function getTotalTopicsPosts()
    {
        return $this->totalTopicsPosts;
    }
    /**
     * Set the value of totalTopicsPosts
     *
     * @return  self
     */ 
    public function setTotalTopicsPosts($totalTopicsPosts)
    {
        $this->totalTopicsPosts = $totalTopicsPosts;
        return $this;
    }


    /**
     * Get the value of totalPosts
     */ 
    public function getTotalPosts()
    {
        return $this->totalPosts;
    }
    /**
     * Set the value of totalPosts
     *
     * @return  self
     */ 
    public function setTotalPosts($totalPosts)
    {
        $this->totalPosts = $totalPosts;
        return $this;
    }

    /**
     * Get the value of totalTopics
     */ 
    public function getTotalTopics()
    {
        return $this->totalTopics;
    }
    /**
     * Set the value of totalTopics
     *
     * @return  self
     */ 
    public function setTotalTopics($totalTopics)
    {
        $this->totalTopics = $totalTopics;
        return $this;
    }


    public function hasRole($role) : bool {
        $result = $this->role == $role;
        return $result;
    }

    public function __toString() {
        return $this->nickname;
    }

    
}