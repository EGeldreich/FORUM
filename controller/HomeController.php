<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index() {

        // create new manager instances
        $categoryManager = new CategoryManager();
        $topicManager = new TopicManager();
        $userManager = new UserManager();

        // Get the list of all categories, sorted by name
        $categories = $categoryManager->findAll(["name", "ASC"]);
        // Get the list of topics, sorted by creation date
        $topics = $topicManager->findAll(["creationDate", "DESC"]);
        // Get the list of top 5 Users
        $users = $userManager->findTopUsers(["number", "DESC"]);

        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum",
            "data" => [
                "categories" => $categories,
                "topics" => $topics,
                "users" => $users
            ]
        ];
    }
        
    public function users(){
        $this->restrictTo("ROLE_USER");

        $manager = new UserManager();
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }

}
