<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class TopicController extends AbstractController implements ControllerInterface {

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
        
    public function findTopic($id){

        // Create new manager instances
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $userManager = new UserManager();

        // Get the topic
        $topic = $topicManager->findOneById($id);
        // Get the posts from that topic
        $posts = $postManager->findTopicPosts($id);

        return [
            "view" => VIEW_DIR."/forum/topic.php",
            "meta_description" => "Topic",
            "data" => [ 
                "topic" => $topic,
                // "userNumberTopics" => $userNumberTopics,
                // "userNumberPosts" => $userNumberPosts,
                "posts" => $posts
            ]
        ];
    }

}
