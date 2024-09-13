<?php
class HoSoRepository implements Repository{
    public function find(){
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM ho_so");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $ho_so = [];
        foreach ($result as $hoSo) {
            array_push($ho_so, HoSo::fromArray($hoSo));
        }
        return $ho_so;
    }
    public function findById($id){
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM ho_so WHERE ho_so_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        if ($result) {
            return HoSo::fromArray($result);
        }
        return null;
    }
     /**
     * Hàm lưu thông tin hồ sơ vào database
     * @param HoSo $hoSo
     * @return int|null
     */
    public function save($hoSo)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare(
            "INSERT INTO ho_so (
                ho_so_id, ho_ten, gioi_tinh, ngay_thang_nam_sinh, dan_toc, so_nha, ten_pho, ten_phuong, ten_thanh_pho, ten_tinh, sdt_1, sdt_2, ten_truong_lop_9, ten_thanh_pho_cua_truong, ten_tinh_cua_truong, so_bao_danh, mon_chuyen_du_thi, nguyen_vong_1, nguyen_vong_2, hanh_kiem_hoc_luc_6, hanh_kiem_hoc_luc_7, hanh_kiem_hoc_luc_8, hanh_kiem_hoc_luc_1_9, loai_tot_nghiep_thcs, diem_tb_mon_chuyen, diem_tb_lop_9, diem_tb_toan_lop_9, diem_tb_van_lop_9, diem_tb_ngoai_ngu_lop_9
            ) VALUES (
                :ho_so_id, :ho_ten, :gioi_tinh, :ngay_thang_nam_sinh, :dan_toc, :so_nha, :ten_pho, :ten_phuong, :ten_thanh_pho, :ten_tinh, :sdt_1, :sdt_2, :ten_truong_lop_9, :ten_thanh_pho_cua_truong, :ten_tinh_cua_truong, :so_bao_danh, :mon_chuyen_du_thi, :nguyen_vong_1, :nguyen_vong_2, :hanh_kiem_hoc_luc_6, :hanh_kiem_hoc_luc_7, :hanh_kiem_hoc_luc_8, :hanh_kiem_hoc_luc_1_9, :loai_tot_nghiep_thcs, :diem_tb_mon_chuyen, :diem_tb_lop_9, :diem_tb_toan_lop_9, :diem_tb_van_lop_9, :diem_tb_ngoai_ngu_lop_9)"
        );
        // Bind các giá trị
        $stmt->bindParam(':ho_so_id', $hoSo->ho_so_id);
        $stmt->bindParam(':ho_ten', $hoSo->ho_ten);
        $stmt->bindParam(':gioi_tinh', $hoSo->gioi_tinh);
        $stmt->bindParam(':ngay_thang_nam_sinh', $hoSo->ngay_thang_nam_sinh);
        $stmt->bindParam(':dan_toc', $hoSo->dan_toc);
        $stmt->bindParam(':so_nha', $hoSo->so_nha);
        $stmt->bindParam(':ten_pho', $hoSo->ten_pho);
        $stmt->bindParam(':ten_phuong', $hoSo->ten_phuong);
        $stmt->bindParam(':ten_thanh_pho', $hoSo->ten_thanh_pho);
        $stmt->bindParam(':ten_tinh', $hoSo->ten_tinh);
        $stmt->bindParam(':sdt_1', $hoSo->sdt_1);
        $stmt->bindParam(':sdt_2', $hoSo->sdt_2);
        $stmt->bindParam(':ten_truong_lop_9', $hoSo->ten_truong_lop_9);
        $stmt->bindParam(':ten_thanh_pho_cua_truong', $hoSo->ten_thanh_pho_cua_truong);
        $stmt->bindParam(':ten_tinh_cua_truong', $hoSo->ten_tinh_cua_truong);
        $stmt->bindParam(':so_bao_danh', $hoSo->so_bao_danh);
        $stmt->bindParam(':mon_chuyen_du_thi', $hoSo->mon_chuyen_du_thi);
        $stmt->bindParam(':nguyen_vong_1', $hoSo->nguyen_vong_1);
        $stmt->bindParam(':nguyen_vong_2', $hoSo->nguyen_vong_2);
        $stmt->bindParam(':hanh_kiem_hoc_luc_6', $hoSo->hanh_kiem_hoc_luc_6);
        $stmt->bindParam(':hanh_kiem_hoc_luc_7', $hoSo->hanh_kiem_hoc_luc_7);
        $stmt->bindParam(':hanh_kiem_hoc_luc_8', $hoSo->hanh_kiem_hoc_luc_8);
        $stmt->bindParam(':hanh_kiem_hoc_luc_1_9', $hoSo->hanh_kiem_hoc_luc_1_9);
        $stmt->bindParam(':loai_tot_nghiep_thcs', $hoSo->loai_tot_nghiep_thcs);
        $stmt->bindParam(':diem_tb_mon_chuyen', $hoSo->diem_tb_mon_chuyen);
        $stmt->bindParam(':diem_tb_lop_9', $hoSo->diem_tb_lop_9);
        $stmt->bindParam(':diem_tb_toan_lop_9', $hoSo->diem_tb_toan_lop_9);
        $stmt->bindParam(':diem_tb_van_lop_9', $hoSo->diem_tb_van_lop_9);
        $stmt->bindParam(':diem_tb_ngoai_ngu_lop_9', $hoSo->diem_tb_ngoai_ngu_lop_9);

        $stmt->execute();
        $result = $conn->lastInsertId();
        $conn = null;
        return $result;
    }
    public function deleteById($id){}
}