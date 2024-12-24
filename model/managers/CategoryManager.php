<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategoryManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Category";
    protected $tableName = "category";

    public function __construct(){
        parent::connect();
    }

    public function findCategoryId($cat){
        $sql = "SELECT t.id_category
                FROM ".$this->tableName." t 
                WHERE t.name = :name";
       
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['name' => $cat], false), 
            $this->className
        );
    }

    public function undisplay($id) {
        $sql = "UPDATE ".$this->tableName."
                SET displayed = 1
                WHERE id_category = :id;";
        
        return DAO::update($sql, ['id' => $id]);
    }

    public function display($id) {
        $sql = "UPDATE ".$this->tableName."
                SET displayed = 0
                WHERE id_category = :id;";
        
        return DAO::update($sql, ['id' => $id]);
    }
}