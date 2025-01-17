<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Topic extends Entity{

    private $id;
    private $title;
    private $content;
    private $user;
    private $category;
    private $creationDate;
    private $closed;

    private $totalPosts;
    private $totalTopics;
    private $sortDate;
    private $postCount;
    private $displayed;

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
     * Get the value of title
     */ 
    public function getTitle(){
        return $this->title;
    }
    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }


    /**
     * Get the value of content
     */ 
    public function getContent(){
        return $this->content;
    }
    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content){
        $this->content = $content;
        return $this;
    }


    /**
     * Get the value of user
     */ 
    public function getUser(){
        return $this->user ?: "DeletedUser";
    }
    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    /**
     * Get the value of creationDate
     */ 
    public function getCreationDate(){
        return $this->creationDate;
    }
    /**
     * Set the value of creationDate
     *
     * @return  self
     */ 
    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory(){
        return $this->category;
    }
    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category){
        $this->category = $category;
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


    /**
     * Get the value of sortDate
     */ 
    public function getSortDate()
    {
        return $this->sortDate;
    }
    /**
     * Set the value of sortDate
     *
     * @return  self
     */ 
    public function setSortDate($sortDate)
    {
        $this->sortDate = $sortDate;
        return $this;
    }


    /**
     * Get the value of postCount
     */ 
    public function getPostCount()
    {
        return $this->postCount;
    }
    /**
     * Set the value of postCount
     *
     * @return  self
     */ 
    public function setPostCount($postCount)
    {
        $this->postCount = $postCount;
        return $this;
    }


    public function __toString(){
        return $this->title;
    }


    /**
     * Get the value of displayed
     */ 
    public function getDisplayed()
    {
        return $this->displayed;
    }

    /**
     * Set the value of displayed
     *
     * @return  self
     */ 
    public function setDisplayed($displayed)
    {
        $this->displayed = $displayed;

        return $this;
    }
}