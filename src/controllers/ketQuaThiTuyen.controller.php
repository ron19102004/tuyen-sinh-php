<?php
class KetQuaThiTuyenController
{
    private $ketQuaRepository;
    public function __construct(KetQuaThiTuyenRepository $ketQuaRepository)
    {
        $this->ketQuaRepository = $ketQuaRepository;
    }
    public function traDiem()
    {
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
    public function layDiemTheoTrang()
    {
        try {
            $page = htmlspecialchars($_GET["page"]);
            $result = $this->ketQuaRepository->findWithPage($page);
            return new Response(true, $result, "Lấy dữ liệu thành công");
        } catch (Exception $e) {
            return new Response(false, $e->getMessage(), "Lỗi trong quá trình lấy dữ liệu");
        }
    }
    public function capNhatDiem()
    {
        try {
            $toan = htmlspecialchars($_POST["toan"]);
            $van = htmlspecialchars($_POST["van"]);
            $nn = htmlspecialchars($_POST["ngoai_ngu"]);
            $chuyen = htmlspecialchars($_POST["chuyen"]);
            $id = htmlspecialchars($_POST["ma_ho_so"]);
            $update = $this->ketQuaRepository->update($toan, $van, $nn, $chuyen, $id);
            return new Response($update, null, $update ? "Cập nhật thành công!" : "Cập nhật thất bại");
        } catch (Exception $e) {
            return new Response(false, $e->getMessage(), "Lỗi trong quá trình cập nhật");
        }
    }
}
