<?php

namespace Service;

use Model\Managers\CategoryManager;
use Model\Managers\UserManager;

class AsideService {

    public static function getAsideContent() {

        $categoryManager = new CategoryManager();
        $userManager = new UserManager();

        $categories = $categoryManager->findAll();
        $users = $userManager->findTopUsers();

        return [
            "categories" => $categories,
            "users" => $users
        ];
    }
}