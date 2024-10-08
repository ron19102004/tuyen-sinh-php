<?php
class KetQuaThiTuyenRepository implements Repository
{
    public function findWithPage($page)
    {
        $offset = ($page - 1) * 10;
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM ket_qua_thi_tuyen LIMIT :offset, 10");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $ds = [];
        foreach ($result as $ketQuaThiTuyen) {
            array_push($ds, KetQuaThiTuyen::fromArray($ketQuaThiTuyen));
        }
        return $ds;
    }
    public function traCuuDiemSo($ma_ho_so, $so_dien_thoai)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare(
            "SELECT ket_qua_thi_tuyen.*,
                           ho_so.ho_ten,
                           ho_so.ngay_thang_nam_sinh
            FROM ket_qua_thi_tuyen
            INNER JOIN ho_so ON ket_qua_thi_tuyen.ket_qua_thi_tuyen_id = ho_so.ho_so_id
            INNER JOIN users ON users.id = ket_qua_thi_tuyen.ket_qua_thi_tuyen_id
            WHERE ket_qua_thi_tuyen.ket_qua_thi_tuyen_id = :ma_ho_so AND users.phone = :so_dien_thoai"
        );
        $stmt->bindParam(':ma_ho_so', $ma_ho_so);
        $stmt->bindParam(':so_dien_thoai', $so_dien_thoai);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        if ($result) {
            return [
                "ket_qua" => KetQuaThiTuyen::fromArray($result),
                "thong_tin" => [
                    "ho_ten" => $result["ho_ten"],
                    "ngay_thang_nam_sinh" => $result["ngay_thang_nam_sinh"]
                ]
            ];
        }
        return null;
    }
    /**
     * Hàm cập nhật thông tin kết quả thi tuyển vào database
     * @return bool
     */
    public function update($diem_toan, $diem_van, $diem_ngoai_ngu, $diem_mon_chuyen, $ket_qua_thi_tuyen_id)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare(
            "UPDATE ket_qua_thi_tuyen
            SET diem_toan = :diem_toan,
                diem_van = :diem_van,
                diem_ngoai_ngu = :diem_ngoai_ngu,
                diem_mon_chuyen = :diem_mon_chuyen
            WHERE ket_qua_thi_tuyen_id = :ket_qua_thi_tuyen_id"
        );

        // Bind các giá trị
        $stmt->bindParam(':diem_toan', $diem_toan);
        $stmt->bindParam(':diem_van', $diem_van);
        $stmt->bindParam(':diem_ngoai_ngu', $diem_ngoai_ngu);
        $stmt->bindParam(':diem_mon_chuyen', $diem_mon_chuyen);
        $stmt->bindParam(':ket_qua_thi_tuyen_id', $ket_qua_thi_tuyen_id);

        $result = $stmt->execute();
        $conn = null;
        return $result;
    }
    /**
     * Hàm lưu thông tin kết quả thi tuyển vào database
     * @param KetQuaThiTuyen $ketQuaThiTuyen
     * @return int|null
     */
    public function save($ketQuaThiTuyen)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare(
            "INSERT INTO ket_qua_thi_tuyen (
                ket_qua_thi_tuyen_id, diem_toan, diem_van, diem_ngoai_ngu, diem_mon_chuyen
            ) VALUES (
                :ket_qua_thi_tuyen_id, :diem_toan, :diem_van, :diem_ngoai_ngu, :diem_mon_chuyen)"
        );

        // Bind các giá trị
        $stmt->bindParam(':ket_qua_thi_tuyen_id', $ketQuaThiTuyen->ket_qua_thi_tuyen_id);
        $stmt->bindParam(':diem_toan', $ketQuaThiTuyen->diem_toan);
        $stmt->bindParam(':diem_van', $ketQuaThiTuyen->diem_van);
        $stmt->bindParam(':diem_ngoai_ngu', $ketQuaThiTuyen->diem_ngoai_ngu);
        $stmt->bindParam(':diem_mon_chuyen', $ketQuaThiTuyen->diem_mon_chuyen);

        $stmt->execute();
        $result = $conn->lastInsertId();
        $conn = null;
        return $result;
    }
    public function find()
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM ket_qua_thi_tuyen");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $kq = [];
        foreach ($result as $item) {
            array_push($kq, KetQuaThiTuyen::fromArray($item));
        }
        return $kq;
    }
    public function deleteById($id) {}
    public function findById($id)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT ket_qua_thi_tuyen.*,ho_so.ho_ten,ho_so.ngay_thang_nam_sinh
                                       FROM ket_qua_thi_tuyen 
                                       INNER JOIN ho_so
                                       IN ho_so.ho_so_id = ket_qua_thi_tuyen.ho_so_id
                                       WHERE ket_qua_thi_tuyen_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        if ($result) {
            return [
                "ket_qua" => KetQuaThiTuyen::fromArray($result),
                "thong_tin" => [
                    "ho_ten" => $result["ho_ten"],
                    "ngay_thang_nam_sinh" => $result["ngay_thang_nam_sinh"]
                ]
            ];
        }
        return null;
    }
}
