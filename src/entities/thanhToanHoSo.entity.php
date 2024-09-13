<?php
class ThanhToanHoSo
{
    public $thanh_toan_ho_so_id, $trang_thai_thanh_toan, $so_tien, $ngay_thanh_toan;

    public function __construct($thanh_toan_ho_so_id, $trang_thai_thanh_toan, $so_tien, $ngay_thanh_toan)
    {
        $this->thanh_toan_ho_so_id = $thanh_toan_ho_so_id;
        $this->trang_thai_thanh_toan = $trang_thai_thanh_toan;
        $this->so_tien = $so_tien;
        $this->ngay_thanh_toan = $ngay_thanh_toan;
    }

    /**
     * @param mixed $data
     * @return ThanhToanHoSo
     */
    public static function fromArray($data)
    {
        return new ThanhToanHoSo(
            $data['thanh_toan_ho_so_id'],
            $data['trang_thai_thanh_toan'],
            $data['so_tien'],
            $data['ngay_thanh_toan'] ?? null
        );
    }

    public function toArray()
    {
        return [
            'thanh_toan_ho_so_id' => $this->thanh_toan_ho_so_id,
            'trang_thai_thanh_toan' => $this->trang_thai_thanh_toan,
            'so_tien' => $this->so_tien,
            'ngay_thanh_toan' => $this->ngay_thanh_toan
        ];
    }
}
