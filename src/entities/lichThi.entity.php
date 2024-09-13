<?php
class LichThi
{
    public $id, $ten_ky_thi, $ten_mon_thi, $ngay_thi, $dia_diem_thi,$gio_thi;

    public function __construct($id, $ten_ky_thi, $ten_mon_thi, $ngay_thi, $dia_diem_thi,$gio_thi)
    {
        $this->id = $id;
        $this->ten_ky_thi = $ten_ky_thi;
        $this->ten_mon_thi = $ten_mon_thi;
        $this->ngay_thi = $ngay_thi;
        $this->dia_diem_thi = $dia_diem_thi;
        $this->gio_thi = $gio_thi;
    }

    /**
     * @param mixed $data
     * @return LichThi
     */
    public static function fromArray($data)
    {
        return new LichThi(
            $data['id'],
            $data['ten_ky_thi'],
            $data['ten_mon_thi'],
            $data['ngay_thi'],
            $data['dia_diem_thi'],
            $data['gio_thi']
        );
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'ten_ky_thi' => $this->ten_ky_thi,
            'ten_mon_thi' => $this->ten_mon_thi,
            'ngay_thi' => $this->ngay_thi,
            'dia_diem_thi' => $this->dia_diem_thi,
            'gio_thi' => $this->gio_thi,
        ];
    }
}
