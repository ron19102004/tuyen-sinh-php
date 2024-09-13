<?php 
class KetQuaThiTuyenRepository implements Repository{
     /**
     * Hàm cập nhật thông tin kết quả thi tuyển vào database
     * @return bool
     */
    public function update($diem_toan,$diem_van,$diem_ngoai_ngu,$diem_mon_chuyen,$ket_qua_thi_tuyen_id)
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
    public function find(){
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM ket_qua_thi_tuyen");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $conn = null;
        $kq = [];
        foreach ($result as $item) {
           array_push($kq,KetQuaThiTuyen::fromArray($item));
        }
        return $kq;
    }
    public function deleteById($id){}
    public function findById($id){
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT ket_qua_thi_tuyen.*,ho_so.ho_ten,ho_so.ngay_thang_nam_sinh
                                       FROM ket_qua_thi_tuyen 
                                       INNER JOIN ho_so
                                       IN ho_so.ho_so_id = ket_qua_thi_tuyen.ho_so_id
                                       WHERE ket_qua_thi_tuyen_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $conn = null;
        if($result){
            return [
                "ket_qua"=>KetQuaThiTuyen::fromArray($result),
                "thong_tin"=>[
                    "ho_ten" => $result["ho_ten"],
                    "ngay_thang_nam_sinh" => $result["ngay_thang_nam_sinh"]
                ]
            ];
        }
        return null;
    }
}