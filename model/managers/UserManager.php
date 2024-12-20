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
            COUNT(DISTINCT topic.id_topic) + COUNT(DISTINCT post.id_post) AS number
        FROM ".$this->tableName." t 
        LEFT JOIN topic ON t.id_user = topic.user_id
        LEFT JOIN post ON t.id_user = post.user_id
        GROUP BY t.id_user
        LIMIT 5;";

        return  $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }
}