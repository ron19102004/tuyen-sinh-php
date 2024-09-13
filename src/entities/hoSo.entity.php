<?php 
class HoSo
{
    public $ho_so_id, $ho_ten, $gioi_tinh, $ngay_thang_nam_sinh, $dan_toc, $so_nha, $ten_pho, $ten_phuong, $ten_thanh_pho, $ten_tinh, $sdt_1, $sdt_2, $ten_truong_lop_9, $ten_thanh_pho_cua_truong, $ten_tinh_cua_truong, $so_bao_danh, $mon_chuyen_du_thi, $nguyen_vong_1, $nguyen_vong_2, $hanh_kiem_hoc_luc_6, $hanh_kiem_hoc_luc_7, $hanh_kiem_hoc_luc_8, $hanh_kiem_hoc_luc_1_9, $loai_tot_nghiep_thcs, $diem_tb_mon_chuyen, $diem_tb_lop_9, $diem_tb_toan_lop_9, $diem_tb_van_lop_9, $diem_tb_ngoai_ngu_lop_9,$ten_ngoai_ngu;

    public function __construct(
        $ho_so_id, $ho_ten, $gioi_tinh, $ngay_thang_nam_sinh, $dan_toc, $so_nha, $ten_pho, $ten_phuong, $ten_thanh_pho, $ten_tinh, $sdt_1, $sdt_2, $ten_truong_lop_9, $ten_thanh_pho_cua_truong, $ten_tinh_cua_truong, $so_bao_danh, $mon_chuyen_du_thi, $nguyen_vong_1, $nguyen_vong_2, $hanh_kiem_hoc_luc_6, $hanh_kiem_hoc_luc_7, $hanh_kiem_hoc_luc_8, $hanh_kiem_hoc_luc_1_9, $loai_tot_nghiep_thcs, $diem_tb_mon_chuyen, $diem_tb_lop_9, $diem_tb_toan_lop_9, $diem_tb_van_lop_9, $diem_tb_ngoai_ngu_lop_9,$ten_ngoai_ngu
    ) {
        $this->ho_so_id = $ho_so_id;
        $this->ho_ten = $ho_ten;
        $this->gioi_tinh = $gioi_tinh;
        $this->ngay_thang_nam_sinh = $ngay_thang_nam_sinh;
        $this->dan_toc = $dan_toc;
        $this->so_nha = $so_nha;
        $this->ten_pho = $ten_pho;
        $this->ten_phuong = $ten_phuong;
        $this->ten_thanh_pho = $ten_thanh_pho;
        $this->ten_tinh = $ten_tinh;
        $this->sdt_1 = $sdt_1;
        $this->sdt_2 = $sdt_2;
        $this->ten_truong_lop_9 = $ten_truong_lop_9;
        $this->ten_thanh_pho_cua_truong = $ten_thanh_pho_cua_truong;
        $this->ten_tinh_cua_truong = $ten_tinh_cua_truong;
        $this->so_bao_danh = $so_bao_danh;
        $this->mon_chuyen_du_thi = $mon_chuyen_du_thi;
        $this->nguyen_vong_1 = $nguyen_vong_1;
        $this->nguyen_vong_2 = $nguyen_vong_2;
        $this->hanh_kiem_hoc_luc_6 = $hanh_kiem_hoc_luc_6;
        $this->hanh_kiem_hoc_luc_7 = $hanh_kiem_hoc_luc_7;
        $this->hanh_kiem_hoc_luc_8 = $hanh_kiem_hoc_luc_8;
        $this->hanh_kiem_hoc_luc_1_9 = $hanh_kiem_hoc_luc_1_9;
        $this->loai_tot_nghiep_thcs = $loai_tot_nghiep_thcs;
        $this->diem_tb_mon_chuyen = $diem_tb_mon_chuyen;
        $this->diem_tb_lop_9 = $diem_tb_lop_9;
        $this->diem_tb_toan_lop_9 = $diem_tb_toan_lop_9;
        $this->diem_tb_van_lop_9 = $diem_tb_van_lop_9;
        $this->diem_tb_ngoai_ngu_lop_9 = $diem_tb_ngoai_ngu_lop_9;
        $this->ten_ngoai_ngu = $ten_ngoai_ngu;
    }

    public static function fromArray($data)
    {
        return new HoSo(
            $data['ho_so_id'],
            $data['ho_ten'],
            $data['gioi_tinh'],
            $data['ngay_thang_nam_sinh'],
            $data['dan_toc'],
            $data['so_nha'],
            $data['ten_pho'],
            $data['ten_phuong'],
            $data['ten_thanh_pho'],
            $data['ten_tinh'],
            $data['sdt_1'],
            $data['sdt_2'],
            $data['ten_truong_lop_9'],
            $data['ten_thanh_pho_cua_truong'],
            $data['ten_tinh_cua_truong'],
            $data['so_bao_danh'],
            $data['mon_chuyen_du_thi'],
            $data['nguyen_vong_1'],
            $data['nguyen_vong_2'],
            $data['hanh_kiem_hoc_luc_6'],
            $data['hanh_kiem_hoc_luc_7'],
            $data['hanh_kiem_hoc_luc_8'],
            $data['hanh_kiem_hoc_luc_1_9'],
            $data['loai_tot_nghiep_thcs'],
            $data['diem_tb_mon_chuyen'],
            $data['diem_tb_lop_9'],
            $data['diem_tb_toan_lop_9'],
            $data['diem_tb_van_lop_9'],
            $data['diem_tb_ngoai_ngu_lop_9'],
            $data['ten_ngoai_ngu']
        );
    }
    public function toArray()
    {
        return [
            'ho_so_id' => $this->ho_so_id,
            'ho_ten' => $this->ho_ten,
            'gioi_tinh' => $this->gioi_tinh,
            'ngay_thang_nam_sinh' => $this->ngay_thang_nam_sinh,
            'dan_toc' => $this->dan_toc,
            'so_nha' => $this->so_nha,
            'ten_pho' => $this->ten_pho,
            'ten_phuong' => $this->ten_phuong,
            'ten_thanh_pho' => $this->ten_thanh_pho,
            'ten_tinh' => $this->ten_tinh,
            'sdt_1' => $this->sdt_1,
            'sdt_2' => $this->sdt_2,
            'ten_truong_lop_9' => $this->ten_truong_lop_9,
            'ten_thanh_pho_cua_truong' => $this->ten_thanh_pho_cua_truong,
            'ten_tinh_cua_truong' => $this->ten_tinh_cua_truong,
            'so_bao_danh' => $this->so_bao_danh,
            'mon_chuyen_du_thi' => $this->mon_chuyen_du_thi,
            'nguyen_vong_1' => $this->nguyen_vong_1,
            'nguyen_vong_2' => $this->nguyen_vong_2,
            'hanh_kiem_hoc_luc_6' => $this->hanh_kiem_hoc_luc_6,
            'hanh_kiem_hoc_luc_7' => $this->hanh_kiem_hoc_luc_7,
            'hanh_kiem_hoc_luc_8' => $this->hanh_kiem_hoc_luc_8,
            'hanh_kiem_hoc_luc_1_9' => $this->hanh_kiem_hoc_luc_1_9,
            'loai_tot_nghiep_thcs' => $this->loai_tot_nghiep_thcs,
            'diem_tb_mon_chuyen' => $this->diem_tb_mon_chuyen,
            'diem_tb_lop_9' => $this->diem_tb_lop_9,
            'diem_tb_toan_lop_9' => $this->diem_tb_toan_lop_9,
            'diem_tb_van_lop_9' => $this->diem_tb_van_lop_9,
            'diem_tb_ngoai_ngu_lop_9' => $this->diem_tb_ngoai_ngu_lop_9,
            'ten_ngoai_ngu' => $this->ten_ngoai_ngu,
        ];
    }
}