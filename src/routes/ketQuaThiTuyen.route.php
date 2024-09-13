<?php
//Import đã có env
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::utils(["route.util.php", "response.util.php"]);
//auth middleware  đã có session util
Import::middlewares(["auth.middleware.php"]);
Import::interfaces(["repository.interface.php"]);
Import::entities(["ketQuaThiTuyen.entity.php", "user.entity.php",]);
Import::repositories(["ketQuaThiTuyen.repository.php"]);
Import::controllers(["ketQuaThiTuyen.controller.php"]);


class KQThiTuyenRoute extends Route
{
    private $kqController;
    public function __construct()
    {
        $kqRepo = new KetQuaThiTuyenRepository();
        $this->kqController = new KetQuaThiTuyenController($kqRepo);
    }
    public function post_action($method)
    {
        switch ($method) {
        }
    }
    public function get_action($method)
    {
        switch ($method) {
            case "tra-cuu-diem": {
                    echo $this->kqController
                        ->traDiem()
                        ->toJson();
                    break;
                }
        }
    }
}

$route = new KQThiTuyenRoute();
$route->run();
