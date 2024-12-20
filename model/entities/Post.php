<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Post extends Entity{

    private $id;
    private $content;
    private $postDate;
    private $topic;
    private $user;
    private $responseNumber;
    private $totalPosts;
    private $totalTopics;
    private $postContent;

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
     * Get the value of postDate
     */ 
    public function getPostDate()
    {
        return $this->postDate;
    }
    /**
     * Set the value of postDate
     *
     * @return  self
     */ 
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;
        return $this;
    }


    /**
     * Get the value of topic
     */ 
    public function getTopic(){
        return $this->topic;
    }
    /**
     * Set the value of topic
     *
     * @return  self
     */ 
    public function setTopic($topic){
        $this->topic = $topic;
        return $this;
    }


    /**
     * Get the value of user
     */ 
    public function getUser(){
        return $this->user;
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
     * Get the value of responseNumber
     */ 
    public function getResponseNumber()
    {
        return $this->responseNumber;
    }
    /**
     * Set the value of responseNumber
     *
     * @return  self
     */ 
    public function setResponseNumber($responseNumber)
    {
        $this->responseNumber = $responseNumber;
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
     * Get the value of postContent
     */ 
    public function getPostContent()
    {
        return $this->postContent;
    }
    /**
     * Set the value of postContent
     *
     * @return  self
     */ 
    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;
        return $this;
    }

    
    public function __toString(){
        return $this->title;
    }

}