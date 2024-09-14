<?php
class TrangThaiHoSoRepository implements Repository
{
    public function countEach()
    {
        $conn = DB::connect();
        $stmt = $conn->query("SELECT
                                COUNT(CASE WHEN trang_thai_ho_so = 'ChoDuyet' THEN 1 END) AS count_ChoDuyet,
                                COUNT(CASE WHEN trang_thai_ho_so = 'DaDuyet' THEN 1 END) AS count_DaDuyet,
                                COUNT(CASE WHEN trang_thai_ho_so = 'TuChoi' THEN 1 END) AS count_TuChoi,
                                COUNT(CASE WHEN trang_thai_ho_so = 'YeuCauChinh' THEN 1 END) AS count_YeuCauChinh
                              FROM 
                                trang_thai_ho_so;");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $result;
    }
    public function capNhatTrangThai($id, $trang_thai, $ghi_chu, $nguoi_cap_nhat)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("UPDATE trang_thai_ho_so SET trang_thai_ho_so = :trang_thai, ghi_chu = :ghi_chu, thong_tin_nguoi_cap_nhat =:thong_tin WHERE trang_thai_ho_so_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':trang_thai', $trang_thai);
        $stmt->bindParam(':ghi_chu', $ghi_chu);
        $stmt->bindParam(':thong_tin', $nguoi_cap_nhat);
        $result = $stmt->execute();
        $conn = null;
        return $result;
    }
    public function count()
    {
        $conn = DB::connect();
        $stmt = $conn->query("SELECT COUNT(*) as count FROM trang_thai_ho_so");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        if ($result) {
            return $result['count'];
        }
        return 0;
    }
    public function find()
    {
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
    public function findWithPageIgnoreId($page,$id)
    {
        $offset = ($page - 1) * 10;
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM trang_thai_ho_so 
        WHERE trang_thai_ho_so_id != :id 
        ORDER BY trang_thai_ho_so_id  LIMIT 10 OFFSET :offset");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $trangThaiHoSo = [];
        foreach ($result as $row) {
            array_push($trangThaiHoSo, TrangThaiHoSo::fromArray($row));
        }
        return $trangThaiHoSo;
    }
    /**
     * @param mixed $id
     * @return TrangThaiHoSo|null
     */
    public function findById($id)
    {
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
    public function deleteById($id) {}
}
