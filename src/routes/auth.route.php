<?php
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::utils(["route.util.php"]);
Import::middlewares(["auth.middleware.php"]);
Import::interfaces(["repository.interface.php"]);
Import::entities(["user.entity.php"]);
Import::repositories(["user.repository.php"]);
Import::controllers(["auth.controller.php"]);


class AuthRoute extends Route {
    private $authController;
    public function __construct(){
        $userRepository = new UserRepository();
        $this->authController = new AuthController($userRepository);
    }
    public function post_action($method){
        switch ($method) {
            case "login":{
                $this->authController->login();
                $this->redirect("user/home/page.php");
                break;
            }
        }
    }
    public function get_action($method){

    }
}

$auth_route = new AuthRoute();
$auth_route->run();