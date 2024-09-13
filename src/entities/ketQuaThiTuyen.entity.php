<?php
class KetQuaThiTuyen
{
    public $ket_qua_thi_tuyen_id;
    public $diem_toan;
    public $diem_van;
    public $diem_ngoai_ngu;
    public $diem_mon_chuyen;

    public function __construct($ket_qua_thi_tuyen_id, $diem_toan = 0.0, $diem_van = 0.0, $diem_ngoai_ngu = 0.0, $diem_mon_chuyen = 0.0)
    {
        $this->ket_qua_thi_tuyen_id = $ket_qua_thi_tuyen_id;
        $this->diem_toan = $diem_toan;
        $this->diem_van = $diem_van;
        $this->diem_ngoai_ngu = $diem_ngoai_ngu;
        $this->diem_mon_chuyen = $diem_mon_chuyen;
    }

    /**
     * Hàm chuyển đổi đối tượng thành mảng
     * @return array
     */
    public function toArray()
    {
        return [
            'ket_qua_thi_tuyen_id' => $this->ket_qua_thi_tuyen_id,
            'diem_toan' => $this->diem_toan,
            'diem_van' => $this->diem_van,
            'diem_ngoai_ngu' => $this->diem_ngoai_ngu,
            'diem_mon_chuyen' => $this->diem_mon_chuyen,
        ];
    }

    /**
     * Hàm tạo đối tượng từ mảng dữ liệu
     * @param array $data
     * @return KetQuaThiTuyen
     */
    public static function fromArray($data)
    {
        return new KetQuaThiTuyen(
            $data['ket_qua_thi_tuyen_id'],
            $data['diem_toan'],
            $data['diem_van'],
            $data['diem_ngoai_ngu'],
            $data['diem_mon_chuyen']
        );
    }
}
