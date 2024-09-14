<?php
//Import đã có env
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::utils(["route.util.php", "response.util.php"]);
//auth middleware  đã có session util
Import::interfaces(["repository.interface.php"]);
Import::entities(["hoSo.entity.php", "trangThaiHoSo.entity.php", "thanhToanHoSo.entity.php"]);
Import::repositories(["hoSo.repository.php", "trangThaiHoSo.repository.php", "user.repository.php", "thanhToanHoSo.repository.php"]);
Import::controllers(["hoSo.controller.php"]);


class HoSoRoute extends Route
{
    private $hoSoController;
    public function __construct()
    {
        $hoSoRepo = new HoSoRepository();
        $trangThaiHSRepo = new TrangThaiHoSoRepository();
        $userRepo = new UserRepository();
        $thanhToanHoSoRepository = new ThanhToanHoSoRepository();
        $this->hoSoController = new HoSoController($hoSoRepo, $trangThaiHSRepo, $userRepo, $thanhToanHoSoRepository);
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
            case "cap-nhat-trang-thai-ho-so": {
                    AuthMiddleware::hasRoles([UserRole::AdmissionCommittee->name], function () {
                        echo $this->hoSoController
                            ->capNhatTrangThaiHoSo()
                            ->toJson();
                    }, function ($mess) {
                        $res = new Response(false, null, $mess);
                        echo $res->toJson();
                    });
                    break;
                }
            case "cap-nhat-trang-thai-thanh-toan": {
                    AuthMiddleware::hasRoles([UserRole::Cashier->name], function () {
                        echo $this->hoSoController
                            ->capNhatTrangThaiThanhToan()
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
                    AuthMiddleware::hasRoles([
                        UserRole::AdmissionCommittee->name,
                        UserRole::BoardOfDirectors->name
                    ], function () {
                        echo $this->hoSoController
                            ->getAllTrangThaiHoSo()
                            ->toJson();
                    }, function ($mess) {
                        $res = new Response(false, null, $mess);
                        echo $res->toJson();
                    });
                    break;
                }
            case "get-all-thanh-toan-hs": {
                    AuthMiddleware::hasRoles([UserRole::Cashier->name], function () {
                        echo $this->hoSoController
                            ->getAllThanhToanHoSo()
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
            case "dem-ban-ghi-thanh-toan-hs": {
                    echo $this->hoSoController
                        ->demSoBanGhiThanhToan()
                        ->toJson();
                    break;
                }
        }
    }
}

$route = new HoSoRoute();
$route->run();
