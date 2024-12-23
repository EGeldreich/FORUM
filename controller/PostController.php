<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class PostController extends AbstractController implements ControllerInterface {

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
            "aside" => true,
            "meta_description" => "Page d'accueil du forum",
            "data" => [
                "categories" => $categories,
                "topics" => $topics,
                "users" => $users
            ]
        ];
        
    }

    public function postPost($id){
        if(isset($_POST['postPost'])) {
            // Sanitize inputs
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
            // Check everything
            if($content){
                $postManager = new PostManager;
                $newPost = $postManager->add([
                    "content" => $content,
                    "topic_id" => $id,
                    "user_id" => 1
                ]);
                // Get managers and datas related to the outgoing page
                $topicManager = new TopicManager();
                $topic = $topicManager->findOneById($id);
                $posts = $postManager->findTopicPosts($id);
            }
        }
        return [
            "view" => VIEW_DIR."/forum/topic.php",
            "meta_description" => "Topic",
            "aside" => true,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
                ]
        ];
    }

}
