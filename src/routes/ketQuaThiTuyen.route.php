<?php
//Import đã có env
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::utils(["route.util.php", "response.util.php"]);
//auth middleware  đã có session util
Import::interfaces(["repository.interface.php"]);
Import::entities(["ketQuaThiTuyen.entity.php",]);
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
            case "cap-nhat-diem": {
                    AuthMiddleware::hasRoles([
                        UserRole::AdmissionCommittee->name,
                        UserRole::BoardOfDirectors->name
                    ], function () {
                        echo $this->kqController
                            ->capNhatDiem()
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
            case "tra-cuu-diem": {
                    echo $this->kqController
                        ->traDiem()
                        ->toJson();
                    break;
                }
            case "lay-diem-theo-trang": {
                    AuthMiddleware::hasRoles(
                        [
                            UserRole::AdmissionCommittee->name,
                            UserRole::BoardOfDirectors->name
                        ],
                        function () {
                            echo $this->kqController
                                ->layDiemTheoTrang()
                                ->toJson();
                        },
                        function ($mess) {
                            $res = new Response(false, null, $mess);
                            echo $res->toJson();
                        }
                    );
                    break;
                }
        }
    }
}

$route = new KQThiTuyenRoute();
$route->run();
