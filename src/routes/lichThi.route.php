<?php
//Import đã có env
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::utils(["route.util.php", "response.util.php"]);
//auth middleware  đã có session util
Import::interfaces(["repository.interface.php"]);
Import::entities(["lichThi.entity.php",]);
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
            case "them-lich-thi": {
                    AuthMiddleware::hasRoles([
                        UserRole::BoardOfDirectors->name
                    ], function () {
                        echo $this->lichThiController
                            ->themLichThi()
                            ->toJson();
                    }, function ($mess) {
                        $res = new Response(false, null, $mess);
                        echo $res->toJson();
                    });
                    break;
                }
            case "xoa-lich-thi": {
                    AuthMiddleware::hasRoles([
                        UserRole::BoardOfDirectors->name
                    ], function () {
                        echo $this->lichThiController
                            ->xoaLichThi()
                            ->toJson();
                    }, function ($mess) {
                        $res = new Response(false, null, $mess);
                        echo $res->toJson();
                    });
                    break;
                }
            case "dat-lich": {
                    AuthMiddleware::hasRoles([
                        UserRole::BoardOfDirectors->name,
                        UserRole::AdmissionCommittee->name
                    ], function () {
                        echo $this->lichThiController
                            ->datLichThiChoHoSo()
                            ->toJson();
                    }, function ($mess) {
                        $res = new Response(false, null, $mess);
                        echo $res->toJson();
                    });
                    break;
                }
            case "xoa-lich-thi-hs": {
                    AuthMiddleware::hasRoles([
                        UserRole::BoardOfDirectors->name,
                        UserRole::AdmissionCommittee->name
                    ], function () {
                        echo $this->lichThiController
                            ->xoaLichThiHS()
                            ->toJson();
                    }, function ($mess) {
                        $res = new Response(false, null, $mess);
                        echo $res->toJson();
                    });
                    break;
                }
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
