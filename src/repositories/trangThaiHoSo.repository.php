<?php
class TrangThaiHoSoRepository implements Repository{
    public function find(){
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM trang_thai_ho_so");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $trangThaiHoSo = [];
        foreach ($result as $row) {
           array_push($trangThaiHoSo, TrangThaiHoSo::fromArray($row));
        }
        return $trangThaiHoSo;
    }
    public function findById($id){
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM trang_thai_ho_so WHERE trang_thai_ho_so_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        if ($result) {
            return TrangThaiHoSo::fromArray($result);
        }
        return null;
    }
     /**
     * Hàm lưu thông tin trạng thái hồ sơ vào database
     * @param TrangThaiHoSo $trangThaiHoSo
     * @return int|null
     */
    public function save($trangThaiHoSo)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare(
            "INSERT INTO trang_thai_ho_so (
                trang_thai_ho_so_id, trang_thai_ho_so, thong_tin_nguoi_cap_nhat, ghi_chu
            ) VALUES (
                :trang_thai_ho_so_id, :trang_thai_ho_so, :thong_tin_nguoi_cap_nhat, :ghi_chu)"
        );

        // Bind các giá trị
        $stmt->bindParam(':trang_thai_ho_so_id', $trangThaiHoSo->trang_thai_ho_so_id);
        $stmt->bindParam(':trang_thai_ho_so', $trangThaiHoSo->trang_thai_ho_so);
        $stmt->bindParam(':thong_tin_nguoi_cap_nhat', $trangThaiHoSo->thong_tin_nguoi_cap_nhat);
        $stmt->bindParam(':ghi_chu', $trangThaiHoSo->ghi_chu);

        $stmt->execute();
        $result = $conn->lastInsertId();
        $conn = null;
        return $result;
    }
    public function deleteById($id){}
}