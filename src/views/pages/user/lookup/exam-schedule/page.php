<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::middlewares(files_name: ["auth.middleware.php"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Tra cứu lịch thi</title>
</head>

<body>
    <!-- header -->
    <?php require Import::view_layout_path("header/user-header.php") ?>
    <!-- main -->
    <div class="bg-blue-800 shadow-lg py-5">
        <div class="container mx-auto px-4">
            <h1 class="text-white text-3xl font-bold text-center">Tra cứu lịch thi xét tuyển</h1>
        </div>
    </div>
    <main class="container mx-auto px-4 py-8 flex-grow">
        <div class="bg-white rounded-lg shadow-xl p-8 max-w-lg mx-auto">
            <h2 class="text-2xl font-semibold mb-6 text-center text-gray-800">Nhập thông tin để tra cứu</h2>

            <form class="space-y-6">
                <!-- Mã hồ sơ -->
                <div>
                    <label for="profile-id" class="block text-gray-700 font-medium">Mã hồ sơ</label>
                    <input type="text" id="profile-id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition duration-300" placeholder="Nhập mã hồ sơ">
                </div>

                <!-- Số điện thoại -->
                <div>
                    <label for="phone" class="block text-gray-700 font-medium">Số điện thoại</label>
                    <input type="text" id="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition duration-300" placeholder="Nhập số điện thoại">
                </div>

                <!-- Nút tra cứu -->
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Tra cứu</button>
                </div>
            </form>
        </div>

        <!-- Kết quả tra cứu -->
        <div class="mt-10 bg-white rounded-lg shadow-lg py-8 md:px-8 max-w-4xl mx-auto">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Kết quả tra cứu</h3>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-blue-800">Mã hồ sơ</th>
                            <th class="px-6 py-4 text-left text-blue-800">Số điện thoại</th>
                            <th class="px-6 py-4 text-left text-blue-800">Ngày thi</th>
                            <th class="px-6 py-4 text-left text-blue-800">Giờ thi</th>
                            <th class="px-6 py-4 text-left text-blue-800">Địa điểm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Ví dụ -->
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 border">HS001</td>
                            <td class="px-6 py-4 border">0123456789</td>
                            <td class="px-6 py-4 border">01/10/2024</td>
                            <td class="px-6 py-4 border">9:00 AM</td>
                            <td class="px-6 py-4 border">Phòng 101, Tòa A</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- footer -->
    <?php include Import::view_layout_path("footer/user-footer.php") ?>
</body>

</html>