<?php
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::utils(["route.util.php", "response.util.php"]);
//auth middleware có đã có session util
Import::interfaces(["repository.interface.php"]);
Import::repositories(["user.repository.php"]);
Import::controllers(["user.controller.php"]);


class UserRoute extends Route
{
    private $userController;
    public function __construct()
    {
        $userRepository = new UserRepository();
        $this->userController = new UserController($userRepository);
    }
    public function post_action($method)
    {
        switch ($method) {
            case "update-role": {
                    AuthMiddleware::hasRoles([UserRole::Admin->name], function () {
                        echo $this->userController
                            ->updateRole()
                            ->toJson();
                    }, function ($message) {
                        $res = new Response(false, null, $message);
                        echo $res->toJson();
                    });
                    break;
                }
        }
    }
    public function get_action($method)
    {
        switch ($method) {
            case "get-accounts": {
                    AuthMiddleware::hasRoles([UserRole::Admin->name], function () {
                        $page = htmlspecialchars($_GET["page"]);
                        echo $this->userController
                            ->getAllAccounts($page)
                            ->toJson();
                    }, function ($message) {
                        $res = new Response(false, null, $message);
                        echo $res->toJson();
                    });
                    break;
                }
            case "count-each-role": {
                    echo $this->userController
                        ->countEachRole()
                        ->toJson();
                    break;
                }
        }
    }
}

$user_route = new UserRoute();
$user_route->run();
