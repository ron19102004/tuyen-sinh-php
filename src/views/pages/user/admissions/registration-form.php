<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::middlewares(files_name: ["auth.middleware.php"]);
AuthMiddleware::isAuthenticated(function () {}, function () {
    header("Location: /src/views/pages/auth/login.php");
})
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
    <!-- Container cho đơn -->
    <div class="container mx-auto my-12 p-6 bg-white shadow-lg rounded-lg max-w-4xl">
        <h1 class="text-3xl font-bold text-center text-blue-800 mb-6">Mẫu Đơn Đăng Ký Tuyển Sinh</h1>
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
                    <label class="block text-gray-700 font-bold mb-2">Ngoại ngữ thi</label>
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
                    <input type="text" id="ethnicity" name="ethnicity" class="w-full p-2 border border-gray-300 rounded-lg" required>
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
                    <label for="exam_subject" class="block text-gray-700 font-bold mb-2">Môn đăng ký dự thi</label>
                    <input type="text" id="exam_subject" name="exam_subject" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="first_choice" class="block text-gray-700 font-bold mb-2">Nguyện vọng 1 vào lớp chuyên</label>
                    <input type="text" id="first_choice" name="first_choice" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="second_choice" class="block text-gray-700 font-bold mb-2">Nguyện vọng 2 vào lớp chuyên</label>
                    <input type="text" id="second_choice" name="second_choice" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <!-- Ngôn ngữ thi -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Ngoại ngữ thi</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center cursor-pointer p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                            <input type="radio" id="english" name="language" value="english" class="form-radio h-5 w-5 text-blue-500 focus:ring-blue-300" required>
                            <span class="ml-3 text-gray-700">Anh</span>
                        </label>
                        <label class="flex items-center cursor-pointer p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                            <input type="radio" id="russian" name="language" value="russian" class="form-radio h-5 w-5 text-blue-500 focus:ring-blue-300" required>
                            <span class="ml-3 text-gray-700">Nga</span>
                        </label>
                        <label class="flex items-center cursor-pointer p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                            <input type="radio" id="french" name="language" value="french" class="form-radio h-5 w-5 text-blue-500 focus:ring-blue-300" required>
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
                                    <input type="text" name="conduct_6" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nhập hạnh kiểm lớp 6" required>
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="text" name="academic_6" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nhập học lực lớp 6" required>
                                </td>
                            </tr>
                            <!-- Lớp 7 -->
                            <tr>
                                <td class="border px-4 py-2 font-medium text-gray-700">Lớp 7</td>
                                <td class="border px-4 py-2">
                                    <input type="text" name="conduct_7" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nhập hạnh kiểm lớp 7" required>
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="text" name="academic_7" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nhập học lực lớp 7" required>
                                </td>
                            </tr>
                            <!-- Lớp 8 -->
                            <tr>
                                <td class="border px-4 py-2 font-medium text-gray-700">Lớp 8</td>
                                <td class="border px-4 py-2">
                                    <input type="text" name="conduct_8" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nhập hạnh kiểm lớp 8" required>
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="text" name="academic_8" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nhập học lực lớp 8" required>
                                </td>
                            </tr>
                            <!-- Học kỳ 1 lớp 9 -->
                            <tr>
                                <td class="border px-4 py-2 font-medium text-gray-700">HK1 Lớp 9</td>
                                <td class="border px-4 py-2">
                                    <input type="text" name="conduct_9_1" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nhập hạnh kiểm HK1 lớp 9" required>
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="text" name="academic_9_1" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nhập học lực HK1 lớp 9" required>
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
                            <tr class="font-semibold bg-gray-100">
                                <td class="border px-4 py-2">Trung Bình Cả 3 Môn</td>
                                <td class="border px-4 py-2">
                                    <input type="number" name="avg_all_subjects" step="0.1" class="w-full p-2 border border-gray-300 rounded-lg bg-gray-200 cursor-not-allowed" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Nút gửi và in -->
                <div class="flex justify-between mt-6">
                    <button type="button" onclick="printForm()" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-800">In Đơn</button>
                    <button id="btn-submit" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-800">Gửi Đơn</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    $(() => {
        $("#btn-submit").click((e) => {
            e.preventDefault();
            // Lấy giá trị từ các trường
            const fullname = $('#fullname').val().trim();
            const gender = $('input[name="gender"]:checked').val();
            const day = $('#day').val();
            const month = $('#month').val();
            const year = $('#year').val();
            const ethnicity = $('#ethnicity').val().trim();
            const houseNumber = $('#house_number').val().trim();
            const street = $('#street').val().trim();
            const ward = $('#ward').val().trim();
            const city = $('#city').val().trim();
            const province = $('#province').val().trim();
            const phone1 = $('#phone1').val().trim();
            const phone2 = $('#phone2').val().trim();
            const schoolName = $('#school_name').val().trim();
            const thcsCity = $('#thcs_city').val().trim();
            const thcsProvince = $('#thcs_province').val().trim();
            const examNumber = $('#exam_number').val().trim();
            const examSubject = $('#exam_subject').val().trim();
            const firstChoice = $('#first_choice').val().trim();
            const secondChoice = $('#second_choice').val().trim();
            const language = $('input[name="language"]:checked').val();
            const specialSubjectAvg = $('#special_subject_avg').val();
            const overallAvg = $('#overall_avg').val();
            const mathAvg = $('input[name="math_avg"]').val();
            const literatureAvg = $('input[name="literature_avg"]').val();
            const foreignLangAvg = $('input[name="foreign_lang_avg"]').val();

            // Hàm kiểm tra tính hợp lệ của các trường
            function validateField(value, message) {
                if (value === '' || value == null) {
                    alert(message);
                    return false;
                }
                return true;
            }

            // Hàm kiểm tra tính hợp lệ của ngày tháng năm
            function isValidDate(day, month, year) {
                const date = new Date(year, month - 1, day); // Tháng trong JS bắt đầu từ 0
                const currentYear = new Date().getFullYear();

                // Kiểm tra ngày tháng năm hợp lệ và năm sinh không quá hiện tại
                return date && date.getDate() === parseInt(day) &&
                    (date.getMonth() + 1) === parseInt(month) &&
                    date.getFullYear() === parseInt(year) &&
                    year <= currentYear;
            }

            // Hàm kiểm tra số điện thoại hợp lệ (10 số và chỉ chứa số)
            function isValidPhoneNumber(phone) {
                const phoneRegex = /^(0|\+84)(3|5|7|8|9)[0-9]{8}$/;
                return phoneRegex.test(phone);
            }

            // Validate từng trường
            if (!validateField(fullname, 'Vui lòng nhập họ và tên') ||
                !validateField(gender, 'Vui lòng chọn giới tính') ||
                !validateField(day, 'Vui lòng nhập ngày sinh') ||
                !validateField(month, 'Vui lòng nhập tháng sinh') ||
                !validateField(year, 'Vui lòng nhập năm sinh') ||
                !validateField(ethnicity, 'Vui lòng nhập dân tộc') ||
                !validateField(houseNumber, 'Vui lòng nhập số nhà') ||
                !validateField(street, 'Vui lòng nhập tên phố') ||
                !validateField(ward, 'Vui lòng nhập phường') ||
                !validateField(city, 'Vui lòng nhập thành phố') ||
                !validateField(province, 'Vui lòng nhập tỉnh') ||
                !validateField(phone1, 'Vui lòng nhập số điện thoại 1') ||
                !validateField(phone2, 'Vui lòng nhập số điện thoại 2') ||
                !validateField(schoolName, 'Vui lòng nhập tên trường THCS lớp 9 đã học') ||
                !validateField(thcsCity, 'Vui lòng nhập thành phố của trường THCS') ||
                !validateField(thcsProvince, 'Vui lòng nhập tỉnh của trường THCS') ||
                !validateField(examNumber, 'Vui lòng nhập số báo danh xét tốt nghiệp THCS') ||
                !validateField(examSubject, 'Vui lòng nhập môn đăng ký dự thi') ||
                !validateField(firstChoice, 'Vui lòng nhập nguyện vọng 1 vào lớp chuyên') ||
                !validateField(secondChoice, 'Vui lòng nhập nguyện vọng 2 vào lớp chuyên') ||
                !validateField(language, 'Vui lòng chọn ngôn ngữ thi') ||
                !validateField(specialSubjectAvg, 'Vui lòng nhập điểm trung bình môn chuyên') ||
                !validateField(overallAvg, 'Vui lòng nhập điểm trung bình các môn') ||
                !validateField(mathAvg, 'Vui lòng nhập điểm trung bình môn Toán') ||
                !validateField(literatureAvg, 'Vui lòng nhập điểm trung bình môn Ngữ Văn') ||
                !validateField(foreignLangAvg, 'Vui lòng nhập điểm trung bình môn Ngoại Ngữ')) {
                return false;
            }

            // Kiểm tra ngày tháng năm hợp lệ
            if (!isValidDate(day, month, year)) {
                alert('Vui lòng nhập ngày tháng năm sinh hợp lệ');
                return false;
            }

            // Kiểm tra số điện thoại hợp lệ
            if (!isValidPhoneNumber(phone1)) {
                alert('Số điện thoại 1 không hợp lệ. Số điện thoại phải có 10 số.');
                return false;
            }
            if (!isValidPhoneNumber(phone2)) {
                alert('Số điện thoại 2 không hợp lệ. Số điện thoại phải có 10 số.');
                return false;
            }
        })
    })
</script>

</html>