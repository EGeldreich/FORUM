<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class TopicController extends AbstractController implements ControllerInterface {

    public function index() {

        $this->redirectTo("home");
        
    }
        
    public function findTopic($id){

        // Create new manager instances
        $postManager = new PostManager();
        $topicManager = new TopicManager();

        // Get the topic
        $topic = $topicManager->findTopic($id);
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
        $this->restrictTo('user');
        return [
            "view" => VIEW_DIR."/forum/newTopic.php",
            "meta_description" => "New topic page",
            "aside" => true,
            "data" => []
        ];
    }

    public function postTopic(){
        $this->restrictTo('user');
        if(isset($_POST['postTopic'])) {
            // Sanitize inputs
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $submittedCategory = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
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
                    "user_id" => Session::getUser()->getId()
                ]);
                // Redirect to the topic page
                $this->redirectTo("topic", "findTopic", $newTopic);
            } else { // if inputs arent verified succesfully
                $this->redirectTo("topic", "newTopic");
            }
        } else { // if POST is not set
            $this->redirectTo("topic", "newTopic");
        }
    }

    public function lockTopic($id) {
        $this->restrictTo('user');
        $topicManager = new TopicManager;

        // Security so only author can lock
        $topic = $topicManager->findOneById($id);
        $userTopicId = $topic->getUser()->getId();
        $loggedUserId = Session::getUser()->getId();
        
        if($userTopicId == $loggedUserId || Session::getUser()->hasRole("ROLE_ADMIN")) {
            $topicManager->lockTopic($id);
        }
        
        $this->redirectTo("topic", "findTopic", "$id");
    }

    public function unlockTopic($id) {
        $this->restrictTo('user');
        $topicManager = new TopicManager;

        // Security so only author can unlock
        $topic = $topicManager->findOneById($id);
        $userTopicId = $topic->getUser()->getId();
        $loggedUserId = Session::getUser()->getId();
        
        if($userTopicId == $loggedUserId || Session::getUser()->hasRole("ROLE_ADMIN")) {
            $topicManager->unlockTopic($id);
        }

        $this->redirectTo("topic", "findTopic", "$id");
    }
}
