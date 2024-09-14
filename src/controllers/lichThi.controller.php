<?php
class LichThiController
{
    private $lichThiRepository;
    public function __construct(LichThiRepository $lichThiRepository)
    {
        $this->lichThiRepository = $lichThiRepository;
    }
    public function traCuuLichThi()
    {
        try {
            $maHoSo = htmlspecialchars($_GET["ma_ho_so"]);
            $sdt = htmlspecialchars($_GET["sdt"]);
            $result = $this->lichThiRepository->timKiemLichThiChoHoSo($maHoSo, $sdt);
            if ($result["thong_tin_ho_so"] == null) {
                return new Response(false, null, "Hồ sơ không tồn tại");
            }
            return new Response(true, $result, "Tra cứu thành công");
        } catch (Exception $e) {
            return new Response(false, $e->getMessage(), "Lỗi trong quá trình tra cứu");
        }
    }
    public function themLichThi()
    {
        try {
            $ten_ky_thi = htmlspecialchars($_POST["ten_ky_thi"]);
            $ten_mon_thi = htmlspecialchars($_POST["ten_mon_thi"]);
            $ngay_thi = htmlspecialchars($_POST["ngay_thi"]);
            $dia_diem_thi = htmlspecialchars($_POST["dia_diem_thi"]);
            $gio_thi = htmlspecialchars($_POST["gio_thi"]);
            $lichThi = new LichThi(0, $ten_ky_thi, $ten_mon_thi, $ngay_thi, $dia_diem_thi, $gio_thi);
            $result = $this->lichThiRepository->save($lichThi);
            return new Response($result, null, $result ? "Thêm lịch thi thành công" : "Thêm lịch thi thất bại");
        } catch (Exception $e) {
            return new Response(false, $e->getMessage(), "Lỗi trong quá trình tra cứu");
        }
    }
}
