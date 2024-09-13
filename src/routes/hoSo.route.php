<?php
//Import đã có env
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::utils(["route.util.php", "response.util.php"]);
//auth middleware  đã có session util
Import::middlewares(["auth.middleware.php"]);
Import::interfaces(["repository.interface.php"]);
Import::entities(["hoSo.entity.php", "user.entity.php"]);
Import::repositories(["hoSo.repository.php"]);
Import::controllers(["hoSo.controller.php"]);


class HoSoRoute extends Route
{
    private $hoSoController;
    public function __construct()
    {
        $hoSoRepo = new HoSoRepository();
        $this->hoSoController = new HoSoController($hoSoRepo);
    }
    public function post_action($method)
    {
        switch ($method) {
            case "tao-ho-so": {
                    AuthMiddleware::hasRoles([UserRole::User->name], function () {
                        echo $this->hoSoController
                            ->taoHoSo()
                            ->toJson();
                    }, function ($mess) {
                        $res = new Response(false, null, $mess);
                        echo $res->toJson();
                    });
                    break;
                }
        }
    }
    public function get_action($method) {}
}

$route = new HoSoRoute();
$route->run();
