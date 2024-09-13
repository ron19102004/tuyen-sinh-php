<?php
class LichThiRepository implements Repository
{
    public function timKiemLichThiChoHoSo($ho_so_id, $so_dien_thoai)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare(
            "SELECT lich_thi.*,
                           ho_so.ho_ten,
                           ho_so.ngay_thang_nam_sinh
        FROM ho_so_lich_thi
        INNER JOIN lich_thi ON ho_so_lich_thi.lich_thi_id = lich_thi.id
        INNER JOIN ho_so ON ho_so_lich_thi.ho_so_id = ho_so.ho_so_id
        INNER JOIN users ON users.id = ho_so.ho_so_id
        WHERE ho_so_lich_thi.ho_so_id = :ho_so_id
        AND users.phone = :phone;"
        );
        $stmt->bindParam(':ho_so_id', $ho_so_id);
        $stmt->bindParam(':phone', $so_dien_thoai);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $lichThis = [];
        $thongTinHoSo = null;
        foreach ($result as $row) {
            $thongTinHoSo = [
                "ho_ten" => $row['ho_ten'],
                "ngay_thang_nam_sinh" => $row['ngay_thang_nam_sinh']
            ];
            array_push($lichThis, LichThi::fromArray($row));
        }
        return [
            "lich_thi" => $lichThis,
            "thong_tin_ho_so" => $thongTinHoSo
        ];
    }
    public function datLichThiChoHoSo($ho_so_id, $lich_thi_id)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare(
            "INSERT INTO ho_so_lich_thi (
                ho_so_id, lich_thi_id
            ) VALUES (
                :ho_so_id, :lich_thi_id)"
        );
        // Bind các giá trị
        $stmt->bindParam(':ho_so_id', $ho_so_id);
        $stmt->bindParam(':lich_thi_id', $lich_thi_id);
        $stmt->execute();
        $result = $conn->lastInsertId();
        $conn = null;
        return $result;
    }
    public function find()
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM lich_thi");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $lichThis = [];
        foreach ($result as $lichThi) {
            array_push($lichThis, LichThi::fromArray($lichThi));
        }
        return $lichThis;
    }
    public function findById($id)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM lich_thi WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        if ($result) {
            return LichThi::fromArray($result);
        }
        return null;
    }
    /**
     * Hàm lưu thông tin lịch thi vào database
     * @param LichThi $lichThi
     * @return int|null
     */
    public function save($lichThi)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare(
            "INSERT INTO lich_thi (
                ten_ky_thi, ten_mon_thi, ngay_thi, dia_diem_thi,gio_thi
            ) VALUES (
                :ten_ky_thi, :ten_mon_thi, :ngay_thi, :dia_diem_thi,:gio_thi)"
        );

        // Bind các giá trị
        $stmt->bindParam(':ten_ky_thi', $lichThi->ten_ky_thi);
        $stmt->bindParam(':ten_mon_thi', $lichThi->ten_mon_thi);
        $stmt->bindParam(':ngay_thi', $lichThi->ngay_thi);
        $stmt->bindParam(':dia_diem_thi', $lichThi->dia_diem_thi);
        $stmt->bindParam(':gio_thi', $lichThi->gio_thi);

        $stmt->execute();
        $result = $conn->lastInsertId();
        $conn = null;
        return $result;
    }
    public function deleteById($id) {}
}
