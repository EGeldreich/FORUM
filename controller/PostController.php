<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class PostController extends AbstractController implements ControllerInterface {

    public function index() {
        $this->redirectTo("home");
    }

    public function newPost($id){
        if(isset($_POST['newPost'])) {
            // Sanitize inputs
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
            // Check everything
            if($content){
                $postManager = new PostManager;
                $newPost = $postManager->add([
                    "content" => $content,
                    "topic_id" => $id,
                    "user_id" => Session::getUser()->getId()
                ]);
                // Get managers and datas related to the outgoing page
                $topicManager = new TopicManager();
                $topic = $topicManager->findOneById($id);
                $posts = $postManager->findTopicPosts($id);

                $this->redirectTo("topic", "findTopic", $id);
            }
        }
    }

}
