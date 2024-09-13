<?php
//Import đã có env
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::utils(["route.util.php", "response.util.php"]);
//auth middleware  đã có session util
Import::middlewares(["auth.middleware.php"]);
Import::interfaces(["repository.interface.php"]);
Import::entities(["lichThi.entity.php", "user.entity.php",]);
Import::repositories(["lichThi.repository.php"]);
Import::controllers(["lichThi.controller.php"]);


class LichThiRoute extends Route
{
    private $lichThiController;
    public function __construct()
    {
        $lichThiRepo = new LichThiRepository();
        $this->lichThiController = new LichThiController($lichThiRepo);
    }
    public function post_action($method)
    {
        switch ($method) {
        }
    }
    public function get_action($method)
    {
        switch ($method) {
            case "tra-lich-thi": {
                    echo $this->lichThiController
                        ->traCuuLichThi()
                        ->toJson();
                    break;
                }
        }
    }
}

$route = new LichThiRoute();
$route->run();
