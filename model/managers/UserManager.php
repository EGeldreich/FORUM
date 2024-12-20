<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    // Find the top Users, and their number of posts
    public function findTopUsers() {
        $sql = "SELECT
            t.nickname,
            COUNT(DISTINCT topic.id_topic) + COUNT(DISTINCT post.id_post) AS totalTopicsPosts
        FROM ".$this->tableName." t 
        LEFT JOIN topic ON t.id_user = topic.user_id
        LEFT JOIN post ON t.id_user = post.user_id
        GROUP BY t.id_user
        ORDER BY totalTopicsPosts DESC
        LIMIT 5;";

        return  $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }

    public function findNumberUserTopics($id) {
        $sql = "SELECT
            t.nickname,
            COUNT(DISTINCT topic.id_topic)AS totalTopics
        FROM ".$this->tableName." t 
        INNER JOIN topic ON t.id_user = topic.user_id
        WHERE t.id_user = :id ;";

        return  $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function findNumberUserPosts($id) {
        $sql = "SELECT
            t.nickname,
            COUNT(DISTINCT post.id_post)AS totalPosts
        FROM ".$this->tableName." t 
        INNER JOIN post ON t.id_user = post.user_id
        WHERE t.id_user = :id ;";

        return  $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }
}