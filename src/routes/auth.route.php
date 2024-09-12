<?php
//Import đã có env
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::utils(["route.util.php", "response.util.php"]);
//auth middleware  đã có session util
Import::middlewares(["auth.middleware.php"]);
Import::interfaces(["repository.interface.php"]);
Import::entities(["user.entity.php"]);
Import::repositories(["user.repository.php"]);
Import::controllers(["auth.controller.php"]);


class AuthRoute extends Route
{
    private $authController;
    public function __construct()
    {
        $userRepository = new UserRepository();
        $this->authController = new AuthController($userRepository);
    }
    public function post_action($method)
    {
        switch ($method) {
            case "login": {
                    echo $this->authController
                        ->login()
                        ->toJson();
                    break;
                }
            case "register": {
                    echo $this->authController
                        ->register()
                        ->toJson();
                    break;
                }
            case "logout": {
                    echo $this->authController
                        ->logout()->toJson();
                    break;
                }
            case "me": {
                    AuthMiddleware::isAuthenticated(function () {
                        echo $this->authController
                            ->me()
                            ->toJson();
                    }, function () {
                        $res = new Response(false, null, "Yêu cầu đăng nhập");
                        echo $res->toJson();
                    });
                    break;
                }
        }
    }
    public function get_action($method) {}
}

$auth_route = new AuthRoute();
$auth_route->run();
