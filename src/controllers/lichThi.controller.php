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
}
