<?php
//Import đã có env
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::utils(["route.util.php", "response.util.php"]);
//auth middleware  đã có session util
Import::middlewares(["auth.middleware.php"]);
Import::interfaces(["repository.interface.php"]);
Import::entities(["hoSo.entity.php", "user.entity.php", "trangThaiHoSo.entity.php"]);
Import::repositories(["hoSo.repository.php", "trangThaiHoSo.repository.php", "user.repository.php"]);
Import::controllers(["hoSo.controller.php"]);


class HoSoRoute extends Route
{
    private $hoSoController;
    public function __construct()
    {
        $hoSoRepo = new HoSoRepository();
        $trangThaiHSRepo = new TrangThaiHoSoRepository();
        $userRepo = new UserRepository();
        $this->hoSoController = new HoSoController($hoSoRepo, $trangThaiHSRepo, $userRepo);
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
            case "cap-nhat-trang-thai": {
                    AuthMiddleware::hasRoles([UserRole::AdmissionCommittee->name], function () {
                        echo $this->hoSoController
                            ->capNhatTrangThai()
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
            case "get-all-trang-thai-hs": {
                    AuthMiddleware::hasRoles([UserRole::AdmissionCommittee->name], function () {
                        echo $this->hoSoController
                            ->getAllTrangThaiHoSo()
                            ->toJson();
                    }, function ($mess) {
                        $res = new Response(false, null, $mess);
                        echo $res->toJson();
                    });
                    break;
                }
            case "dem-ban-ghi-trang-thai-hs": {
                    echo $this->hoSoController
                        ->demSoBanGhiTrangThai()
                        ->toJson();
                    break;
                }
        }
    }
}

$route = new HoSoRoute();
$route->run();
