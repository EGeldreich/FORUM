<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout
    public function index() {
        $this->redirectTo("home");
    }
    public function registerPage() {
        return [
            "view" => VIEW_DIR."/authentification/register.php",
            "meta_description" => "Register page",
            "aside" => false,
            "data" => []
        ];
    }
    public function loginPage() {
        return [
            "view" => VIEW_DIR."/authentification/login.php",
            "meta_description" => "Login page",
            "aside" => false,
            "data" => []
        ];
    }
    public function register() {
        if(isset($_POST['register'])){

            // Sanitize inputs
            $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
            $pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_SPECIAL_CHARS);

            // Check inputs
            if($mail && $pseudo && $pass1 && $pass2) {
                // Check if the mail does not already exist in DB
                $userManager = new UserManager();
                $mailUsed = $userManager->findUserFromMail($mail);
                $pseudoUsed = $userManager->findUserFromPseudo($pseudo);
                
                if($mailUsed) { 
                    // If mail used, head to login with new data
                    return [
                        "view" => VIEW_DIR."/authentification/login.php",
                        "meta_description" => "Login page",
                        "aside" => false,
                        "data" => ["mail" => $mailUsed->getMail()]
                    ];
                } else {
                    if($pseudoUsed){
                        // If pseudo used, head to register again
                        $this->redirectTo("security", "registerPage");
                    } else {
                        // Email and pseudo not used, can check password

                        if($pass1 == $pass2 && strlen($pass1) >= 8){
                            $insertUser = $userManager->add([
                                "mail" => $mail,
                                "nickname" => $pseudo,
                                "password" => password_hash($pass1, PASSWORD_DEFAULT)
                            ]);
                            // User added to DB

                            // Log in user
                                // Find the user
                            $user = $userManager->findUserFromMail($mail);
                            // Add him in Session
                            // Session::setUser($user);

                            $this->redirectTo("home");
                        }
                    }
                }
            }
        } else { // if POST not set
            $this->redirectTo("security", "registerPage");
        }
    }
    public function login() {}
    public function logout() {}
}