<?php
class HoSoController
{
    private $hoSoRepository;
    public function __construct(HoSoRepository $hoSoRepository)
    {
        $this->hoSoRepository = $hoSoRepository;
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

        $ho_so = new HoSo(0, $fullName, $gender, $ngay_thang_nam_sinh, $ethnicity, $houseNumber, $street, $ward, $city, $province, $phone1, $phone2, $schoolName, $thcsCity, $thcsProvince, $examNumber, $examSubject, $firstChoice, $secondChoice, $hk_hl_6, $hk_hl_7, $hk_hl_8, $hk_hl_1_9, "", $specialSubjectAvg, $overallAvg, $mathAvg, $literatureAvg, $foreignLangAvg);

        return new Response(true, $ho_so->toArray(), "Tạo thành công hồ sơ!");
    }
}
