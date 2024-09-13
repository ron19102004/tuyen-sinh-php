<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::entities(["user.entity.php", "hoSo.entity.php"]);
Import::interfaces(["repository.interface.php"]);
Import::repositories(["hoSo.repository.php"]);
Import::middlewares(files_name: ["auth.middleware.php"]);
AuthMiddleware::hasRoles([UserRole::User->name], fn() => null, function () {
    header("Location: /src/views/pages/auth/login.php");
});
$jsonEthnicity = file_get_contents(filename: "./ethnicity.json");
$ethnicityData = json_decode($jsonEthnicity, true);
$hoSoRepo = new HoSoRepository();
$tonTaiHoSo = $hoSoRepo->findById(Session::get("user_id"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Tuyển sinh</title>
</head>

<body>
    <!-- header -->
    <?php require Import::view_layout_path("header/user-header.php") ?>
    <!-- Nếu tồn tại hồ sơ thì ẩn form đăng ký -->
    <?php if ($tonTaiHoSo == null) : ?>
        <!-- Container cho đơn -->
        <div class="container mx-auto md:my-12 p-6 bg-white shadow-lg rounded-lg max-w-4xl" id="root">
            <h1 class="text-2xl md:text-3xl font-bold text-blue-800 mb-6 text-center md:flex items-center justify-center">
                <i class="fas fa-user-edit text-blue-800 mr-3 text-2xl md:text-4xl"></i>
                <p>Mẫu Đơn Đăng Ký Tuyển Sinh</p>
            </h1>
            <!-- Form -->
            <div id="registrationForm">
                <form>
                    <!-- Họ và tên -->
                    <div class="mb-4">
                        <label for="fullname" class="block text-gray-700 font-bold mb-2">Họ và tên</label>
                        <input type="text" id="fullname" name="fullname" placeholder="HỌ VÀ TÊN" class="w-full p-2 border border-gray-300 rounded-lg uppercase" required>
                    </div>

                    <!-- Giới tính -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Giới tính</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center cursor-pointer p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                <input type="radio" id="male" name="gender" value="male" class="form-radio h-5 w-5 text-blue-500 focus:ring-blue-300" required>
                                <span class="ml-3 text-gray-700">Nam</span>
                            </label>
                            <label class="flex items-center cursor-pointer p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                <input type="radio" id="female" name="gender" value="female" class="form-radio h-5 w-5 text-blue-500 focus:ring-blue-300" required>
                                <span class="ml-3 text-gray-700">Nữ</span>
                            </label>
                        </div>
                    </div>


                    <!-- Ngày sinh -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Ngày sinh</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <input type="number" id="day" name="day" placeholder="Ngày" class="w-full p-2 border border-gray-300 rounded-lg" min="1" max="31" required>
                            <input type="number" id="month" name="month" placeholder="Tháng" class="w-full p-2 border border-gray-300 rounded-lg" min="1" max="12" required>
                            <input type="number" id="year" name="year" placeholder="Năm" class="w-full p-2 border border-gray-300 rounded-lg" min="1900" max="2100" required>
                        </div>
                    </div>

                    <!-- Dân tộc -->
                    <div class="mb-4">
                        <label for="ethnicity" class="block text-gray-700 font-bold mb-2">Dân tộc</label>
                        <select name="ethnicity" id="ethnicity" class="w-full p-2 border border-gray-300 rounded-lg" required>
                            <option value="" hidden>-- Chọn dân tộc --</option>
                            <?php
                            foreach ($ethnicityData as $key => $value) {
                                echo '<option value="' . $value["name"] . '">' . $value["name"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Nơi ở hiện nay -->
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Nơi ở hiện nay</label>
                        <input type="text" id="house_number" name="house_number" placeholder="Số nhà" class="w-full p-2 border border-gray-300 rounded-lg mb-2" required>
                        <input type="text" id="street" name="street" placeholder="Phố" class="w-full p-2 border border-gray-300 rounded-lg mb-2" required>
                        <input type="text" id="ward" name="ward" placeholder="Phường" class="w-full p-2 border border-gray-300 rounded-lg mb-2" required>
                        <input type="text" id="city" name="city" placeholder="Thành phố" class="w-full p-2 border border-gray-300 rounded-lg mb-2" required>
                        <input type="text" id="province" name="province" placeholder="Tỉnh" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Số điện thoại liên hệ -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Số điện thoại liên hệ<span class="italic">(bố,mẹ)</span></label>
                        <input type="tel" id="phone1" name="phone1" placeholder="Số điện thoại 1" class="w-full p-2 border border-gray-300 rounded-lg mb-2" required>
                        <input type="tel" id="phone2" name="phone2" placeholder="Số điện thoại 2" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- THCS lớp 9 -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">THCS lớp 9 đã học</label>
                        <input type="text" id="school_name" name="school_name" placeholder="Trường" class="w-full p-2 border border-gray-300 rounded-lg mb-2" required>
                        <input type="text" id="thcs_city" name="thcs_city" placeholder="Thành phố" class="w-full p-2 border border-gray-300 rounded-lg mb-2" required>
                        <input type="text" id="thcs_province" name="thcs_province" placeholder="Tỉnh" class="w-full p-2 border border-gray-300 rounded-lg mb-2" required>
                        <input type="text" id="exam_number" name="exam_number" placeholder="Số báo danh xét tốt nghiệp THCS" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Nguyện vọng -->
                    <div class="mb-4">
                        <label for="exam_subject" class="block text-gray-700 font-bold mb-2">Môn chuyên đăng ký dự thi</label>
                        <select name="exam_subject" id="exam_subject" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="" hidden>Chọn môn chuyên đăng ký dự thi</option>
                            <option value="Toán(Chuyên)">Toán(Chuyên)</option>
                            <option value="Lý(Chuyên)">Lý(Chuyên)</option>
                            <option value="Hóa(Chuyên)">Hóa(Chuyên)</option>
                            <option value="Anh(Chuyên)">Anh(Chuyên)</option>
                            <option value="Văn(Chuyên)">Văn(Chuyên)</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="first_choice" class="block text-gray-700 font-bold mb-2">Nguyện vọng 1 vào lớp chuyên</label>
                        <select name="first_choice" id="first_choice" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="" hidden>Chọn nguyện vọng 1 vào lớp chuyên</option>
                            <option value="Toán">Toán</option>
                            <option value="Lý">Lý</option>
                            <option value="Hóa">Hóa</option>
                            <option value="Anh">Anh</option>
                            <option value="Văn">Văn</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="second_choice" class="block text-gray-700 font-bold mb-2">Nguyện vọng 2 vào lớp chuyên</label>
                        <select name="second_choice" id="second_choice" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="" hidden>Chọn nguyện vọng 1 vào lớp chuyên</option>
                            <option value="Toán">Toán</option>
                            <option value="Lý">Lý</option>
                            <option value="Hóa">Hóa</option>
                            <option value="Anh">Anh</option>
                            <option value="Văn">Văn</option>
                        </select>
                    </div>
                    <!-- Ngôn ngữ thi -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Ngoại ngữ thi</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center cursor-pointer p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                <input type="radio" id="english" name="language" value="Tiếng Anh" class="form-radio h-5 w-5 text-blue-500 focus:ring-blue-300" required>
                                <span class="ml-3 text-gray-700">Anh</span>
                            </label>
                            <label class="flex items-center cursor-pointer p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                <input type="radio" id="russian" name="language" value="Tiếng Nga" class="form-radio h-5 w-5 text-blue-500 focus:ring-blue-300" required>
                                <span class="ml-3 text-gray-700">Nga</span>
                            </label>
                            <label class="flex items-center cursor-pointer p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                <input type="radio" id="french" name="language" value="Tiếng Pháp" class="form-radio h-5 w-5 text-blue-500 focus:ring-blue-300" required>
                                <span class="ml-3 text-gray-700">Pháp</span>
                            </label>
                        </div>
                    </div>

                    <!-- Bảng hạnh kiểm và học lực -->
                    <div class="mb-8">
                        <label class="block text-gray-800 text-lg font-semibold mb-4">Bảng Hạnh Kiểm và Học Lực</label>
                        <table class="w-full border-collapse border border-gray-300 bg-white shadow-lg rounded-lg">
                            <thead class="bg-blue-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left text-gray-600">Học Kỳ</th>
                                    <th class="border px-4 py-2 text-left text-gray-600">Hạnh Kiểm</th>
                                    <th class="border px-4 py-2 text-left text-gray-600">Học Lực</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Lớp 6 -->
                                <tr>
                                    <td class="border px-4 py-2 font-medium text-gray-700">Lớp 6</td>
                                    <td class="border px-4 py-2">
                                        <select name="conduct_6" id="conduct_6" class="w-full p-2 border border-gray-300 rounded-lg">
                                            <option value="" hidden>Chọn hạnh kiểm lớp 6</option>
                                            <option value="Trung Bình">Trung bình</option>
                                            <option value="Khá">Khá</option>
                                            <option value="Tốt">Tốt</option>
                                        </select>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <select name="academic_6" id="academic_6" class="w-full p-2 border border-gray-300 rounded-lg">
                                            <option value="" hidden>Chọn học lực lớp 6</option>
                                            <option value="Trung Bình">Trung bình</option>
                                            <option value="Khá">Khá</option>
                                            <option value="Tốt">Giỏi</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- Lớp 7 -->
                                <tr>
                                    <td class="border px-4 py-2 font-medium text-gray-700">Lớp 7</td>
                                    <td class="border px-4 py-2">
                                        <select name="conduct_7" id="conduct_7" class="w-full p-2 border border-gray-300 rounded-lg">
                                            <option value="" hidden>Chọn hạnh kiểm lớp 7</option>
                                            <option value="Trung Bình">Trung bình</option>
                                            <option value="Khá">Khá</option>
                                            <option value="Tốt">Tốt</option>
                                        </select>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <select name="academic_7" id="academic_7" class="w-full p-2 border border-gray-300 rounded-lg">
                                            <option value="" hidden>Chọn học lực lớp 7</option>
                                            <option value="Trung Bình">Trung bình</option>
                                            <option value="Khá">Khá</option>
                                            <option value="Tốt">Giỏi</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- Lớp 8 -->
                                <tr>
                                    <td class="border px-4 py-2 font-medium text-gray-700">Lớp 8</td>
                                    <td class="border px-4 py-2">
                                        <select name="conduct_8" id="conduct_8" class="w-full p-2 border border-gray-300 rounded-lg">
                                            <option value="" hidden>Chọn hạnh kiểm lớp 8</option>
                                            <option value="Trung Bình">Trung bình</option>
                                            <option value="Khá">Khá</option>
                                            <option value="Tốt">Tốt</option>
                                        </select>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <select name="academic_8" id="academic_8" class="w-full p-2 border border-gray-300 rounded-lg">
                                            <option value="" hidden>Chọn học lực lớp 8</option>
                                            <option value="Trung Bình">Trung bình</option>
                                            <option value="Khá">Khá</option>
                                            <option value="Tốt">Giỏi</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- Học kỳ 1 lớp 9 -->
                                <tr>
                                    <td class="border px-4 py-2 font-medium text-gray-700">HK1 Lớp 9</td>
                                    <td class="border px-4 py-2">
                                        <select name="conduct_9_1" id="conduct_9_1" class="w-full p-2 border border-gray-300 rounded-lg">
                                            <option value="" hidden>Chọn hạnh kiểm HK1 lớp 9</option>
                                            <option value="Trung Bình">Trung bình</option>
                                            <option value="Khá">Khá</option>
                                            <option value="Tốt">Tốt</option>
                                        </select>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <select name="academic_9_1" id="academic_9_1" class="w-full p-2 border border-gray-300 rounded-lg">
                                            <option value="" hidden>Chọn học lực HK1 lớp 9</option>
                                            <option value="Trung Bình">Trung bình</option>
                                            <option value="Khá">Khá</option>
                                            <option value="Tốt">Giỏi</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Điểm trung bình môn chuyên -->
                    <div class="mb-8">
                        <label for="special_subject_avg" class="block text-gray-800 text-lg font-semibold mb-2">Điểm trung bình môn chuyên <span class="italic">(đăng ký dự thi)</span> cả năm lớp 9:</label>
                        <input type="number" id="special_subject_avg" name="special_subject_avg" step="0.1" placeholder="Nhập điểm trung bình môn chuyên" class="w-full p-3 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-600 transition duration-150 ease-in-out" required>
                    </div>

                    <!-- Điểm trung bình các môn -->
                    <div class="mb-8">
                        <label for="overall_avg" class="block text-gray-800 text-lg font-semibold mb-2">Điểm trung bình các môn cả năm lớp 9</label>
                        <input type="number" id="overall_avg" name="overall_avg" step="0.1" placeholder="Nhập điểm trung bình các môn" class="w-full p-3 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-600 transition duration-150 ease-in-out" required>
                    </div>

                    <!-- Bảng điểm -->
                    <div class="mb-8">
                        <label class="block text-gray-800 text-lg font-semibold mb-4">Điểm trung bình các môn</label>
                        <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-blue-100 text-gray-700">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Môn</th>
                                    <th class="border px-4 py-2 text-left">Điểm Trung Bình</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">Toán</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" name="math_avg" step="0.1" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition duration-150 ease-in-out" required>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">Ngữ Văn</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" name="literature_avg" step="0.1" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition duration-150 ease-in-out" required>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">Ngoại Ngữ</td>
                                    <td class="border px-4 py-2">
                                        <input type="number" name="foreign_lang_avg" step="0.1" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 transition duration-150 ease-in-out" required>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Nút gửi và in -->
                    <div class="flex justify-end mt-6">
                        <button id="btn-submit" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-800">Gửi Đơn</button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="flex items-center justify-center md:py-20 ">
            <div class="w-full max-w-md p-8 bg-white rounded-xl md:shadow-lg">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 text-center flex items-center justify-center">
                    <i class="fas fa-user-edit text-blue-800 mr-3 text-2xl md:text-4xl"></i>
                    Đăng ký dự thi
                </h1>
                <p class="text-gray-500 text-center mb-10 flex items-center justify-center">
                    <i class="fas fa-info-circle text-yellow-500 mr-2 text-xl md:text-3xl"></i>
                    Hồ sơ đã được tạo bởi tài khoản này
                </p>
                <div class="flex justify-center">
                    <a href="./resume.php" target="_blank" class="px-6 py-3 bg-blue-800 text-white rounded-lg font-semibold shadow hover:bg-blue-600 transition-all flex items-center">
                        <i class="fas fa-file-alt mr-2 text-xl md:text-2xl"></i>
                        Xem hồ sơ
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php require Import::view_layout_path("footer/user-footer.php"); ?>
</body>
<script>
    $(() => {
        $("#btn-submit").click((e) => {
            e.preventDefault();
            const fullname = $('#fullname').val();
            const gender = $('input[name="gender"]:checked').val();
            const day = $('#day').val();
            const month = $('#month').val();
            const year = $('#year').val();
            const ethnicity = $('#ethnicity').val();
            const houseNumber = $('#house_number').val();
            const street = $('#street').val();
            const ward = $('#ward').val();
            const city = $('#city').val();
            const province = $('#province').val();
            const phone1 = $('#phone1').val();
            const phone2 = $('#phone2').val();
            const schoolName = $('#school_name').val();
            const thcsCity = $('#thcs_city').val();
            const thcsProvince = $('#thcs_province').val();
            const examNumber = $('#exam_number').val();
            const examSubject = $('#exam_subject').val();
            const firstChoice = $('#first_choice').val();
            const secondChoice = $('#second_choice').val();
            const language = $('input[name="language"]:checked').val();
            const specialSubjectAvg = $('#special_subject_avg').val();
            const overallAvg = $('#overall_avg').val();
            const mathAvg = $('input[name="math_avg"]').val();
            const literatureAvg = $('input[name="literature_avg"]').val();
            const foreignLangAvg = $('input[name="foreign_lang_avg"]').val();

            // Lấy giá trị từ bảng hạnh kiểm và học lực
            const conduct6 = $('#conduct_6').val();
            const academic6 = $('#academic_6').val();
            const conduct7 = $('#conduct_7').val();
            const academic7 = $('#academic_7').val();
            const conduct8 = $('#conduct_8').val();
            const academic8 = $('#academic_8').val();
            const conduct9_1 = $('#conduct_9_1').val();
            const academic9_1 = $('#academic_9_1').val();

            $.ajax({
                url: '<?php echo Import::route_path("hoSo.route.php"); ?>',
                method: 'POST',
                data: {
                    method: "tao-ho-so",
                    fullname: fullname,
                    gender: gender,
                    day: day,
                    month: month,
                    year: year,
                    ethnicity: ethnicity,
                    houseNumber: houseNumber,
                    street: street,
                    ward: ward,
                    city: city,
                    province: province,
                    phone1: phone1,
                    phone2: phone2,
                    schoolName: schoolName,
                    thcsCity: thcsCity,
                    thcsProvince: thcsProvince,
                    examNumber: examNumber,
                    examSubject: examSubject,
                    firstChoice: firstChoice,
                    secondChoice: secondChoice,
                    language: language,
                    specialSubjectAvg: specialSubjectAvg,
                    overallAvg: overallAvg,
                    mathAvg: mathAvg,
                    literatureAvg: literatureAvg,
                    foreignLangAvg: foreignLangAvg,
                    conduct6: conduct6,
                    academic6: academic6,
                    conduct7: conduct7,
                    academic7: academic7,
                    conduct8: conduct8,
                    academic8: academic8,
                    conduct9_1: conduct9_1,
                    academic9_1: academic9_1
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    console.log(data);
                    
                    Toastify({
                        text: data.message,
                        duration: 2000,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: data.status ? "green" : "red",
                        },
                    }).showToast();
                    if (data.status) {
                        setTimeout(() => {
                            const html = `
                            <div class="flex items-center justify-center md:py-20 ">
                                <div class="w-full max-w-md p-8 bg-white">
                                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 text-center flex items-center justify-center">
                                        <i class="fas fa-user-edit text-blue-800 mr-3 text-2xl md:text-4xl"></i>
                                        Đăng ký dự thi
                                    </h1>
                                    <!-- Thông báo thành công, ẩn mặc định -->
                                    <div id="successMessage" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Đăng ký thành công! Cảm ơn bạn đã đăng ký.
                                    </div>
                                    <div class="flex justify-center">
                                        <a href="./resume.php" target="_blank" class="px-6 py-3 bg-blue-800 text-white rounded-lg font-semibold shadow hover:bg-blue-600 transition-all flex items-center">
                                            <i class="fas fa-file-alt mr-2 text-xl md:text-2xl"></i>
                                            Xem hồ sơ
                                        </a>
                                    </div>
                                </div>
                            </div>`
                            $("#root").html(html);
                        }, 2000)
                    }
                },
            });
            // In ra console để kiểm tra
            console.log({
                "Họ và tên": fullname,
                "Giới tính": gender,
                "Ngày sinh": day,
                "Tháng sinh": month,
                "Năm sinh": year,
                "Dân tộc": ethnicity,
                "Số nhà": houseNumber,
                "Phố": street,
                "Phường": ward,
                "Thành phố": city,
                "Tỉnh": province,
                "Số điện thoại 1": phone1,
                "Số điện thoại 2": phone2,
                "Tên trường THCS": schoolName,
                "Thành phố THCS": thcsCity,
                "Tỉnh THCS": thcsProvince,
                "Số báo danh thi tốt nghiệp THCS": examNumber,
                "Môn đăng ký dự thi": examSubject,
                "Nguyện vọng 1": firstChoice,
                "Nguyện vọng 2": secondChoice,
                "Ngoại ngữ": language,
                "Điểm trung bình môn chuyên lớp 9": specialSubjectAvg,
                "Điểm trung bình cả năm lớp 9": overallAvg,
                "Điểm trung bình môn Toán": mathAvg,
                "Điểm trung bình môn Ngữ văn": literatureAvg,
                "Điểm trung bình môn Ngoại ngữ": foreignLangAvg,
                "Hạnh kiểm lớp 6": conduct6,
                "Học lực lớp 6": academic6,
                "Hạnh kiểm lớp 7": conduct7,
                "Học lực lớp 7": academic7,
                "Hạnh kiểm lớp 8": conduct8,
                "Học lực lớp 8": academic8,
                "Hạnh kiểm HK1 lớp 9": conduct9_1,
                "Học lực HK1 lớp 9": academic9_1
            });
        })
    })
</script>

</html>