<?php
class ThanhToanHoSoRepository implements Repository
{
    public function xacNhanThanhToan($id)
    {
        $conn = DB::connect();
        $date = new DateTime();
        $date = $date->format('Y-m-d');
        $stmt = $conn->prepare("UPDATE thanh_toan_ho_so SET trang_thai_thanh_toan = 1, ngay_thanh_toan = :ngay_thanh_toan WHERE thanh_toan_ho_so_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ngay_thanh_toan', $date);
        $result = $stmt->execute();
        $conn = null;
        return $result;
    }
    public function countEach()
    {
        $conn = DB::connect();
        $stmt = $conn->query("SELECT
                                COUNT(CASE WHEN trang_thai_thanh_toan = 0 THEN 1 END) AS count_chua_thanh_toan,
                                COUNT(CASE WHEN trang_thai_thanh_toan = 1 THEN 1 END) AS count_da_thanh_toan
                              FROM 
                                thanh_toan_ho_so;");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        return $result;
    }
    public function findWithPage($page)
    {
        $offset = ($page - 1) * 10;
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM thanh_toan_ho_so LIMIT 10 OFFSET :offset");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $ds = [];
        foreach ($result as $thanhToanHoSo) {
            array_push($ds, ThanhToanHoSo::fromArray($thanhToanHoSo));
        }
        return $ds;
    }
    public function count()
    {
        $conn = DB::connect();
        $stmt = $conn->query("SELECT COUNT(*) as count FROM thanh_toan_ho_so");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        return $result["count"];
    }
    public function find()
    {
        $conn = DB::connect();
        $stmt = $conn->query("SELECT * FROM thanh_toan_ho_so");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $ds = [];
        foreach ($result as $thanhToanHoSo) {
            array_push($ds, ThanhToanHoSo::fromArray($thanhToanHoSo));
        }
        return $result;
    }
    /**
     * @param mixed $id
     * @return ThanhToanHoSo|null
     */
    public function findById($id)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM thanh_toan_ho_so WHERE thanh_toan_ho_so_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        if ($result) {
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
