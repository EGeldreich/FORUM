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

    public function findUserFromMail($mail) {

        // SQL Request to get all posts from a topic, ordered chronologically
        // with a number increasing for each post
        $sql = "SELECT *
                FROM ".$this->tableName."
                WHERE mail = :mail
                ";
        
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['mail' => $mail], false), 
            $this->className
        );
    }
    public function findUserFromPseudo($pseudo) {

        // SQL Request to get all posts from a topic, ordered chronologically
        // with a number increasing for each post
        $sql = "SELECT *
                FROM ".$this->tableName."
                WHERE nickname = :pseudo
                ";
        
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $pseudo], false), 
            $this->className
        );
    }

    public function banUser($id){

        $sql = "UPDATE ".$this->tableName."
                SET ban = 1
                WHERE id_user = :id;";
        
        return DAO::update($sql, ['id' => $id]);
    }

    public function unbanUser($id){

        $sql = "UPDATE ".$this->tableName."
                SET ban = 0
                WHERE id_user = :id;";
        
        return DAO::update($sql, ['id' => $id]);
    }

    public function findProfileData($id) {

        $sql = "SELECT
                    u.nickname,
                    u.mail,
                    u.registrationDate,
                    (SELECT COUNT(*) FROM post WHERE user_id = u.id_user) AS totalPosts,
                    (SELECT COUNT(*) FROM topic WHERE user_id = u.id_user) AS totalTopics
                FROM
                    ".$this->tableName." u
                LEFT JOIN post p ON u.id_user = p.user_id
                LEFT JOIN topic t ON u.id_user = t.user_id
                WHERE u.id_user = :id";
        
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false), 
            $this->className
        );
    }

    public function deleteUser($id) {
        
    }
}