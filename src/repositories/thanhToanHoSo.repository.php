<?php
class ThanhToanHoSoRepository implements Repository
{
    public function find()
    {
        $conn = DB::connect();
        $stmt = $conn->query("SELECT * FROM thanh_toan_ho_so");
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $conn = null;
        $ds = [];
        foreach ($result as $thanhToanHoSo) {
            array_push($ds, ThanhToanHoSo::fromArray($thanhToanHoSo));
        }
        return $result;
    }
    public function findById($id) {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM thanh_toan_ho_so WHERE thanh_toan_ho_so_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $conn = null;
        if($result){
            return ThanhToanHoSo::fromArray($result);
        }
        return null;
    }
    /**
     * Hàm lưu thông tin thanh toán hồ sơ vào database
     * @param ThanhToanHoSo $thanhToanHoSo
     * @return int|null
     */
    public function save($thanhToanHoSo)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare(
            "INSERT INTO thanh_toan_ho_so (
                thanh_toan_ho_so_id, trang_thai_thanh_toan, so_tien, ngay_thanh_toan
            ) VALUES (
                :thanh_toan_ho_so_id, :trang_thai_thanh_toan, :so_tien, :ngay_thanh_toan)"
        );
        // Bind các giá trị
        $stmt->bindParam(':thanh_toan_ho_so_id', $thanhToanHoSo->thanh_toan_ho_so_id);
        $stmt->bindParam(':trang_thai_thanh_toan', $thanhToanHoSo->trang_thai_thanh_toan);
        $stmt->bindParam(':so_tien', $thanhToanHoSo->so_tien);
        $stmt->bindParam(':ngay_thanh_toan', $thanhToanHoSo->ngay_thanh_toan);

        $stmt->execute();
        $result = $conn->lastInsertId();
        $conn = null;
        return $result;
    }
    public function deleteById($id) {}
}
