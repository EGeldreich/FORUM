<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    public function findTopic($id) {
        $sql = "SELECT
                    t.id_topic,
                    t.title,
                    t.user_id,
                    t.content,
                    t.creationDate,
                    t.closed,
                    t.category_id,
                    (SELECT COUNT(*) FROM post WHERE user_id = u.id_user) AS totalPosts,
                    (SELECT COUNT(*) FROM topic WHERE user_id = u.id_user) AS totalTopics
                FROM
                    topic t
                LEFT JOIN post p ON t.id_topic = p.topic_id
                LEFT JOIN user u ON p.user_id = u.id_user
                WHERE t.id_topic = :id
                LIMIT 1";
                
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false), 
            $this->className
        );
    }
    public function lockTopic($id){

        $sql = "UPDATE topic
                SET closed = 1
                WHERE id_topic = :id;";
        
        return DAO::update($sql, ['id' => $id]);
    }

    public function unlockTopic($id){

        $sql = "UPDATE topic
                SET closed = 0
                WHERE id_topic = :id;";
        
        return DAO::update($sql, ['id' => $id]);
    }


    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.category_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }
    
}