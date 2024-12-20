<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        parent::connect();
    }

    public function findTopicPosts($id) {

        // SQL Request to get all posts from a topic, ordered chronologically
        // with a number increasing for each post
        $sql = "SELECT
                    t.id_topic,
                    t.title,
                    t.user_id,
                    t.content,
                    p.id_post,
                    p.content AS postContent,
                    p.postDate,
                    p.user_id,
                    u.nickname AS postUser,
                    (SELECT COUNT(*) FROM post WHERE user_id = u.id_user) AS totalPosts,
                    (SELECT COUNT(*) FROM topic WHERE user_id = u.id_user) AS totalTopics,
	                ROW_NUMBER() OVER (ORDER BY p.postDate) AS responseNumber
                FROM
                    topic t
                LEFT JOIN post p ON t.id_topic = p.topic_id
                LEFT JOIN user u ON p.user_id = u.id_user
                WHERE t.id_topic = :id
                ORDER BY
                    p.postDate";
        
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

}