<?php
namespace Controller;

use App\Session;
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
                    Session::addFlash('error', 'There is already an account with this mail.');
                    return [
                        "view" => VIEW_DIR."/authentification/login.php",
                        "meta_description" => "Login page",
                        "aside" => false,
                        "data" => ["mail" => $mailUsed->getMail()]
                    ];
                } else {
                    if($pseudoUsed){
                        // If pseudo used, head to register again
                        Session::addFlash('error', 'This pseudo is already in use.');
                        $this->redirectTo("security", "registerPage");
                    } else {
                        // Email and pseudo not used, can check password
                        $regex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";

                        if($pass1 == $pass2 && preg_match($regex, $pass1)){
                            $user = $userManager->add([
                                "mail" => $mail,
                                "nickname" => $pseudo,
                                "password" => password_hash($pass1, PASSWORD_DEFAULT)
                            ]);// User added to DB
                            
                            // Log in user
                                // Find the user
                            $user = $userManager->findUserFromMail($mail);
                            // Add him in Session
                            Session::setUser($user);
                            Session::addFlash('success', "You successfully registered. You are logged in");
                            $this->redirectTo("home");
                        } else {
                            // Pass word do not match regex
                            Session::addFlash('error', 'Password must contain 8 characters, with at least 1 lettre, 1 number and 1 special character.');
                            $this->redirectTo("security", "registerPage");
                        }
                    }
                }
            }
        } else { // if POST not set
            Session::addFlash('error', "Stop messing with the url.");
            $this->redirectTo("security", "registerPage");
        }
    }
    public function login() {
        if(isset($_POST['login'])){

            // Sanitize inputs
            $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            
            // Check inputs
            if($mail && $password) {
                // Check if the mail does not already exist in DB
                $userManager = new UserManager();
                $user = $userManager->findUserFromMail($mail);
                
                
                if($user) { // if user exists, it means the mail is correct
                    $hash = $user->getPassword(); // get hashed pwd from DB
                    if ($hash == password_verify($password, $hash)) { // verify pwd
                        if($user->getBan() == 0){
                            Session::setUser($user);
                            $this->redirectTo("home");
                        } else {
                            Session::addFlash('error', "You are banned :(");
                            $this->redirectTo("home");
                        }
                    } else {
                        Session::addFlash('error', "Wrong Password or Email.");
                    }
                } else {
                    Session::addFlash('error', "Wrong Password or Email.");
                }
            }
        } else { // if POST not set
            Session::addFlash('error', "Stop messing with the url.");
            $this->redirectTo("security", "loginPage");
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        $this->redirectTo("security", "loginPage");
    }

    public function banUser($id) {
        $this->restrictTo("ROLE_ADMIN");
        $manager = new UserManager;
        $manager->banUser($id);
        Session::addFlash('success', "User banned");
        $this->redirectTo("home", "users");
    }
    public function unbanUser($id) {
        $this->restrictTo("ROLE_ADMIN");
        $manager = new UserManager;
        $manager->unbanUser($id);
        Session::addFlash('success', "User unbanned");
        $this->redirectTo("home", "users");
    }

    public function profile() {
        $this->restrictTo("user");
        $manager = new UserManager;
        $id = Session::getUser()->getId();
        $user = $manager->findProfileData($id);

        return [
            "view" => VIEW_DIR."/security/profile.php",
            "meta_description" => "Profile page",
            "aside" => true,
            "data" => ["user" => $user]
        ];
    }

    public function deleteUser() {
        $this->restrictTo("user");
        $manager = new UserManager;
        $id = Session::getUser()->getId();
        $manager->delete($id);
        unset($_SESSION['user']);
        Session::addFlash('success', "Account successfully deleted");
        $this->redirectTo("home");
    }
}
