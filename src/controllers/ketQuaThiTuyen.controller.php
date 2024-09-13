<?php
class KetQuaThiTuyenController{
    private $ketQuaRepository;
    public function __construct(KetQuaThiTuyenRepository $ketQuaRepository){
        $this->ketQuaRepository = $ketQuaRepository;
    }
    public function traDiem(){
        try {
            $maHoSo = htmlspecialchars($_GET["ma_ho_so"]);
            $sdt = htmlspecialchars($_GET["sdt"]);
            $result = $this->ketQuaRepository->traCuuDiemSo($maHoSo, $sdt);
            if ($result == null) {
                return new Response(false, null, "Không tìm thấy");
            }
            return new Response(true, $result, "Tra cứu thành công");
        } catch (Exception $e) {
            return new Response(false, $e->getMessage(), "Lỗi trong quá trình tra cứu");
        }
    }
}