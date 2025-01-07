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
        $topicManager = new TopicManager();

        // Get the list of topics, sorted by creation date
        // $topics = $topicManager->findAll(["creationDate", "DESC"]);
        $topics = $topicManager->findTopicsData();


        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum",
            "aside" => true,
            "data" => [
                "topics" => $topics,
            ]
        ];
    }
        
    public function users(){
        $this->restrictTo("ROLE_ADMIN");

        $manager = new UserManager();
        $users = $manager->findAll(['registrationDate', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "aside" => false,
            "data" => [ 
                "users" => $users 
            ]
        ];
    }
}
