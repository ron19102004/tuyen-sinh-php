<?php
class HoSoController
{
    private $hoSoRepository, $trangThaiHoSoRepository,$userRepository;
    public function __construct(HoSoRepository $hoSoRepository, TrangThaiHoSoRepository $trangThaiHoSoRepository,UserRepository $userRepository)
    {
        $this->hoSoRepository = $hoSoRepository;
        $this->trangThaiHoSoRepository = $trangThaiHoSoRepository;
        $this->userRepository = $userRepository;
    }
    public function demSoBanGhiTrangThai(){
        $data = $this->trangThaiHoSoRepository->countEach();
        return new Response(true, $data, "Thanh cong");
    }
    public function capNhatTrangThai(){
        $userUpdate = $this->userRepository->findById(Session::get("user_id"));
        $trangThaiHoSoId = htmlspecialchars($_POST["trangThaiHoSoId"]);
        $trangThai = htmlspecialchars($_POST["trangThai"]);
        $ghiChu = htmlspecialchars($_POST["ghiChu"]);

        $update = $this->trangThaiHoSoRepository->capNhatTrangThai($trangThaiHoSoId,$trangThai,$ghiChu,$userUpdate->fullName."#".$userUpdate->role);
        return new Response($update, null, $update? "Cập nhật thành công!" : "Cập nhật thất bại");
    }
    public function getAllTrangThaiHoSo()
    {
        $page = htmlspecialchars($_GET["page"]);
        $data = $this->trangThaiHoSoRepository->findWithPageIgnoreId($page, Session::get("user_id"));
        return new Response(true, $data, "Đã lấy");
    }
    public function taoHoSo(): Response
    {
        $fullName = htmlspecialchars($_POST["fullname"] ?? '');
        $gender = htmlspecialchars($_POST["gender"] ?? '');
        $day = htmlspecialchars($_POST["day"] ?? '');
        $month = htmlspecialchars($_POST["month"] ?? '');
        $year = htmlspecialchars($_POST["year"] ?? '');
        $ethnicity = htmlspecialchars($_POST["ethnicity"] ?? '');
        $houseNumber = htmlspecialchars($_POST["houseNumber"] ?? '');
        $street = htmlspecialchars($_POST["street"] ?? '');
        $ward = htmlspecialchars($_POST["ward"] ?? '');
        $city = htmlspecialchars($_POST["city"] ?? '');
        $province = htmlspecialchars($_POST["province"] ?? '');
        $phone1 = htmlspecialchars($_POST["phone1"] ?? '');
        $phone2 = htmlspecialchars($_POST["phone2"] ?? '');
        $schoolName = htmlspecialchars($_POST["schoolName"] ?? '');
        $thcsCity = htmlspecialchars($_POST["thcsCity"] ?? '');
        $thcsProvince = htmlspecialchars($_POST["thcsProvince"] ?? '');
        $examNumber = htmlspecialchars($_POST["examNumber"] ?? '');
        $examSubject = htmlspecialchars($_POST["examSubject"] ?? '');
        $firstChoice = htmlspecialchars($_POST["firstChoice"] ?? '');
        $secondChoice = htmlspecialchars($_POST["secondChoice"] ?? '');
        $language = htmlspecialchars($_POST["language"] ?? '');
        $specialSubjectAvg = htmlspecialchars($_POST["specialSubjectAvg"] ?? '');
        $overallAvg = htmlspecialchars($_POST["overallAvg"] ?? '');
        $mathAvg = htmlspecialchars($_POST["mathAvg"] ?? '');
        $literatureAvg = htmlspecialchars($_POST["literatureAvg"] ?? '');
        $foreignLangAvg = htmlspecialchars($_POST["foreignLangAvg"] ?? '');
        $conduct6 = htmlspecialchars($_POST["conduct6"] ?? '');
        $academic6 = htmlspecialchars($_POST["academic6"] ?? '');
        $conduct7 = htmlspecialchars($_POST["conduct7"] ?? '');
        $academic7 = htmlspecialchars($_POST["academic7"] ?? '');
        $conduct8 = htmlspecialchars($_POST["conduct8"] ?? '');
        $academic8 = htmlspecialchars($_POST["academic8"] ?? '');
        $conduct9_1 = htmlspecialchars($_POST["conduct9_1"] ?? '');
        $academic9_1 = htmlspecialchars($_POST["academic9_1"] ?? '');

        $ngay_thang_nam_sinh = $day . '-' . $month . '-' . $year;
        $hk_hl_6 = $conduct6 . '-' . $academic6;
        $hk_hl_7 =  $conduct7 . '-' . $academic7;
        $hk_hl_8 =  $conduct8 . '-' . $academic8;
        $hk_hl_1_9 = $conduct9_1 . '-' . $academic9_1;

        $ho_so = new HoSo(Session::get("user_id"), $fullName, $gender, $ngay_thang_nam_sinh, $ethnicity, $houseNumber, $street, $ward, $city, $province, $phone1, $phone2, $schoolName, $thcsCity, $thcsProvince, $examNumber, $examSubject, $firstChoice, $secondChoice, $hk_hl_6, $hk_hl_7, $hk_hl_8, $hk_hl_1_9, "", $specialSubjectAvg, $overallAvg, $mathAvg, $literatureAvg, $foreignLangAvg, $language);
        $trang_thai_ho_so = new TrangThaiHoSo(Session::get("user_id"), null, TrangThaiHoSoEnum::ChoDuyet->name, "User", "");
        try {
            $this->hoSoRepository->save($ho_so);
            $this->trangThaiHoSoRepository->save($trang_thai_ho_so);
        } catch (Exception $e) {
            return new Response(false,  $e->getMessage(),  "Tạo hồ sơ thất bại!");
        }
        return new Response(true, $ho_so->toArray(),  "Tạo thành công hồ sơ!");
    }
}
