<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::entities(["hoSo.entity.php", "trangThaiHoSo.entity.php", "thanhToanHoSo.entity.php", "lichThi.entity.php"]);
Import::interfaces(["repository.interface.php"]);
Import::repositories(["hoSo.repository.php", "trangThaiHoSo.repository.php", "thanhToanHoSo.repository.php", "lichThi.repository.php"]);
AuthMiddleware::isAuthenticated(function () {}, function () {
    header("Location: /src/views/pages/auth/login.php");
});

$hoSoCuaToi = null;
$trangThaiHoSo = null;
$thanhToanHoSo = null;
$lichThi = null;
try {
    $hoSoRepo = new HoSoRepository();
    $trangThaiHoSoRepo = new TrangThaiHoSoRepository();
    $thanhToanHoSoRepo = new ThanhToanHoSoRepository();
    $lichThiRepo = new LichThiRepository();
    $id = Session::get("user_id");
    $hoSoCuaToi = $hoSoRepo->findById($id);
    $trangThaiHoSo = $trangThaiHoSoRepo->findById($id);
    $thanhToanHoSo = $thanhToanHoSoRepo->findById($id);
    $lichThi = $lichThiRepo->findAllByHoSoId($id);
} catch (Exception $e) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Hồ sơ của tôi</title>
</head>

<body>
    <?php if ($hoSoCuaToi != null): ?>
        <main class="max-w-4xl shadow-xl mx-auto md:mt-10 relative" id="bienBan">
            <?php if ($thanhToanHoSo != null && $thanhToanHoSo->trang_thai_thanh_toan == 1): ?>
                <div class="absolute top-12 left-10 -rotate-12 w-36 h-36">
                    <img src="<?php echo Import::view_assets_path("dau_moc.png") ?>" alt="dấu mộc">
                </div>
            <?php endif; ?>
            <!-- Header -->
            <header class="text-center py-8 text-white <?php echo ($thanhToanHoSo == null || ($thanhToanHoSo != null && $thanhToanHoSo->trang_thai_thanh_toan == 0)) ? "bg-red-500 " : "bg-blue-500 " ?>">
                <div class="mb-4">
                    <h1 class="text-3xl font-bold tracking-wider ">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h1>
                    <p class="text-sm font-semibold tracking-widest">Độc lập - Tự do - Hạnh phúc</p>
                </div>
                <div class="border-t border-white w-24 mx-auto mb-4"></div>
                <h2 class="text-2xl font-bold ">SỞ GIÁO DỤC VÀ ĐÀO TẠO</h2>
                <h3 class="text-xl font-semibold uppercase">TRƯỜNG CHUYÊN <?php echo Env::get("system")["name"] ?></h3>
            </header>

            <!-- Nội dung chính -->
            <section class="max-w-5xl mx-auto bg-white mt-8 p-10">

                <h2 class="text-3xl font-bold text-gray-800 mb-8 border-b-2 border-gray-200 pb-2">Thông Tin Đăng Ký Dự Thi</h2>

                <!-- Thông tin cá nhân -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Thông Tin Cá Nhân</h3>
                    <div class="grid grid-cols-2 gap-6 text-gray-600">
                        <p><strong>Họ và tên:</strong> <?php echo $hoSoCuaToi->ho_ten ?></p>
                        <p><strong>Giới tính:</strong> <?php echo $hoSoCuaToi->gioi_tinh == "male" ? "Nam" : "Nữ" ?></p>
                        <p><strong>Ngày sinh:</strong> <?php echo $hoSoCuaToi->ngay_thang_nam_sinh ?></p>
                        <p><strong>Dân tộc:</strong> <?php echo $hoSoCuaToi->dan_toc ?></p>
                        <p><strong>Nơi ở hiện nay:</strong> <?php echo $hoSoCuaToi->so_nha . ', ' . $hoSoCuaToi->ten_pho . ', ' . $hoSoCuaToi->ten_phuong . ', ' . $hoSoCuaToi->ten_thanh_pho . ', ' . $hoSoCuaToi->ten_tinh ?></p>
                        <p><strong>Số điện thoại liên hệ:</strong> 0987654321</p>
                    </div>
                </div>

                <!-- Thông tin THCS và nguyện vọng -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Thông Tin THCS và Nguyện Vọng</h3>
                    <div class="grid grid-cols-2 gap-6 text-gray-600">
                        <p><strong>Trường THCS:</strong> <?php echo $hoSoCuaToi->ten_truong_lop_9 ?></p>
                        <p><strong>Thành phố/Tỉnh:</strong> <?php echo $hoSoCuaToi->ten_tinh_cua_truong ?></p>
                        <p><strong>Số báo danh xét tốt nghiệp:</strong> <?php echo $hoSoCuaToi->so_bao_danh ?></p>
                        <p><strong>Môn đăng ký dự thi:</strong> <?php echo $hoSoCuaToi->mon_chuyen_du_thi ?></p>
                        <p><strong>Nguyện vọng 1:</strong> Lớp Chuyên <?php echo $hoSoCuaToi->nguyen_vong_1 ?></p>
                        <p><strong>Nguyện vọng 2:</strong> Lớp Chuyên <?php echo $hoSoCuaToi->nguyen_vong_2 ?></p>
                        <p><strong>Ngoại ngữ:</strong> <?php echo $hoSoCuaToi->ten_ngoai_ngu ?></p>
                    </div>
                </div>

                <!-- Bảng hạnh kiểm và học lực -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Bảng Hạnh Kiểm và Học Lực</h3>
                    <table class="w-full table-auto border-collapse border border-gray-300 text-gray-700">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border border-gray-300 px-4 py-2 text-left">Lớp</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Hạnh Kiểm-Học lực</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Lớp 6</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php echo $hoSoCuaToi->hanh_kiem_hoc_luc_6 ?>
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">Lớp 7</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php echo $hoSoCuaToi->hanh_kiem_hoc_luc_7 ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Lớp 8</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php echo $hoSoCuaToi->hanh_kiem_hoc_luc_8 ?>
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">HK1 Lớp 9</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php echo $hoSoCuaToi->hanh_kiem_hoc_luc_1_9 ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Điểm trung bình môn chuyên -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Điểm Trung Bình Môn</h3>
                    <p class="text-gray-600"><strong>Điểm trung bình môn chuyên đăng ký dự thi (Lớp 9):</strong> <?php echo $hoSoCuaToi->diem_tb_mon_chuyen ?></p>
                    <p class="text-gray-600"><strong>Điểm trung bình các môn cả năm lớp 9:</strong> <?php echo $hoSoCuaToi->diem_tb_lop_9 ?></p>
                </div>

                <!-- Điểm trung bình các môn Toán, Ngữ văn, Ngoại ngữ -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Điểm Trung Bình Các Môn</h3>
                    <table class="w-full table-auto border-collapse border border-gray-300 text-gray-700">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border border-gray-300 px-4 py-2 text-left">Môn</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Điểm Trung Bình</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Toán</td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $hoSoCuaToi->diem_tb_toan_lop_9 ?></td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">Ngữ văn</td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $hoSoCuaToi->diem_tb_van_lop_9 ?></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Ngoại ngữ</td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $hoSoCuaToi->diem_tb_ngoai_ngu_lop_9 ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php if ($lichThi != null): ?>
                    <!-- lịch thi  -->
                    <div class="overflow-x-auto">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Lịch thi chi tiết</h3>
                        <table class="table-auto w-full border-collapse border border-gray-200">
                            <thead class="bg-gray-100 border-b border-gray-300">
                                <tr>
                                    <th class="px-6 py-4 text-left  border-r border-gray-300">Tên kỳ thi</th>
                                    <th class="px-6 py-4 text-left  border-r border-gray-300">Tên môn thi</th>
                                    <th class="px-6 py-4 text-left  border-r border-gray-300">Ngày thi</th>
                                    <th class="px-6 py-4 text-left  border-r border-gray-300">Giờ</th>
                                    <th class="px-6 py-4 text-left ">Địa điểm thi</th>
                                </tr>
                            </thead>
                            <tbody id="result-table-body">
                                <?php foreach ($lichThi as $lichThiItem): ?>
                                    <tr class="bg-gray-50 border-b border-gray-200">
                                        <td class="px-6 py-4 text-left border-r border-gray-200"><?php echo $lichThiItem->ten_ky_thi ?></td>
                                        <td class="px-6 py-4 text-left border-r border-gray-200"><?php echo $lichThiItem->ten_mon_thi ?></td>
                                        <td class="px-6 py-4 text-left border-r border-gray-200"><?php echo date("d/m/Y", strtotime($lichThiItem->ngay_thi)) ?></td>
                                        <td class="px-6 py-4 text-left border-r border-gray-200"><?php echo $lichThiItem->gio_thi ?></td>
                                        <td class="px-6 py-4 text-left"><?php echo $lichThiItem->dia_diem_thi ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php endif; ?>
            </section>

            <!-- Footer -->
            <footer class="text-center py-6 text-white  <?php echo ($thanhToanHoSo == null || ($thanhToanHoSo != null && $thanhToanHoSo->trang_thai_thanh_toan == 0)) ? "bg-red-500 " : "bg-blue-500" ?>">
                <p>&copy; <?php echo date("Y"); ?> Trường Chuyên <?php echo Env::get("system")["name"] ?> - Sở Giáo Dục và Đào Tạo</p>
            </footer>
        </main>
        <div class="flex flex-col justify-center items-center">
            <button onclick="printDiv('bienBan');" class="my-5 bg-blue-800 text-white px-6 py-3 rounded shadow hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
                In Biên Bản
            </button>
        </div>
    <?php else: ?>
        <section class="max-w-4xl mx-auto bg-white md:shadow-md p-8 rounded-lg mt-6 text-center">
            <h2 class="text-2xl font-bold text-red-600 mb-6">Không Tìm Thấy Thông Tin Đăng Ký</h2>
            <p class="text-lg mb-4">Rất tiếc, chúng tôi không tìm thấy thông tin đăng ký dự thi theo yêu cầu của bạn.</p>
            <p class="text-lg mb-4">Vui lòng kiểm tra lại mã số đăng ký hoặc liên hệ với nhà trường để được hỗ trợ.</p>
            <div class="mt-6">
                <a href="<?php echo Env::get("server"); ?>" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700">
                    Quay lại Trang Chủ
                </a>
            </div>
        </section>

    <?php endif; ?>
</body>
<script>
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = '<html><head><title>In Biên Bản</title></head><body>' + printContents + '</body></html>';
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

</html>