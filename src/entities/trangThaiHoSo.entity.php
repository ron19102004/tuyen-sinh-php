<?php
class TrangThaiHoSo
{
    public $trang_thai_ho_so_id, $created_at, $trang_thai_ho_so, $thong_tin_nguoi_cap_nhat, $ghi_chu;

    public function __construct($trang_thai_ho_so_id, $created_at, $trang_thai_ho_so, $thong_tin_nguoi_cap_nhat, $ghi_chu)
    {
        $this->trang_thai_ho_so_id = $trang_thai_ho_so_id;
        $this->created_at = $created_at;
        $this->trang_thai_ho_so = $trang_thai_ho_so;
        $this->thong_tin_nguoi_cap_nhat = $thong_tin_nguoi_cap_nhat;
        $this->ghi_chu = $ghi_chu;
    }

    /**
     * @param mixed $data
     * @return TrangThaiHoSo
     */
    public static function fromArray($data)
    {
        return new TrangThaiHoSo(
            $data['trang_thai_ho_so_id'],
            $data['created_at'],
            $data['trang_thai_ho_so'],
            $data['thong_tin_nguoi_cap_nhat'],
            $data['ghi_chu'] ?? null
        );
    }

    public function toArray()
    {
        return [
            'trang_thai_ho_so_id' => $this->trang_thai_ho_so_id,
            'created_at' => $this->created_at,
            'trang_thai_ho_so' => $this->trang_thai_ho_so,
            'thong_tin_nguoi_cap_nhat' => $this->thong_tin_nguoi_cap_nhat,
            'ghi_chu' => $this->ghi_chu
        ];
    }
}
