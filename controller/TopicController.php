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
            "aside" => true,
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

        // Get the topic
        $topic = $topicManager->findOneById($id);
        // Get the posts from that topic
        $posts = $postManager->findTopicPosts($id);

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

    public function newTopic(){

        return [
            "view" => VIEW_DIR."/forum/newTopic.php",
            "meta_description" => "New topic page",
            "aside" => true,
            "data" => []
        ];
    }

    public function postTopic(){
        if(isset($_POST['postTopic'])) {
            // Sanitize inputs
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            // $submittedCategory = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
            $submittedCategory = "Chickens";
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);

            // Check if the category is legit
            $categoryManager = new CategoryManager;
            $allowedCategories = ["Farm Life", "DIY Builds", "Gardening", "Chickens", "Food Conservation"];
            $categoryOk = in_array($submittedCategory, $allowedCategories);

            // Get category id
            $category = $categoryManager->findCategoryId($submittedCategory);
            if ($category) {
                $categoryId = $category->getId();
            }
            // Check everything
            if($title && strlen($title) <= 100 && $categoryOk && $content){
                $topicManager = new TopicManager;
                $newTopic = $topicManager->add([
                    "title" => $title,
                    "category_id" => $categoryId,
                    "content" => $content,
                    "user_id" => 1
                ]);
                // Get managers and datas related to the outgoing page
                $topicManager = new TopicManager();
                $postManager = new PostManager();
                $topic = $topicManager->findOneById($newTopic);
                $posts = $postManager->findTopicPosts($newTopic);
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
