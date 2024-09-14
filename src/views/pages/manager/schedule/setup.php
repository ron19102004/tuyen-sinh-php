<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::interfaces(["repository.interface.php"]);
Import::repositories(["lichThi.repository.php", "hoSo.repository.php", "user.repository.php"]);
Import::entities(["lichThi.entity.php", "hoSo.entity.php"]);
AuthMiddleware::hasRoles([
    UserRole::AdmissionCommittee->name,
    UserRole::BoardOfDirectors->name
], function () {}, function ($message) {
    header("Location: /src/views/pages/auth/login.php");
});

$hoSo = null;
$ds_lich = [];
$user = null;
if (isset($_GET["user_id"]) && !empty($_GET["user_id"])) {
    try {
        $hoSoRepo = new HoSoRepository();
        $lichThiRepo = new LichThiRepository();
        $userRepo = new UserRepository();
        $id = htmlspecialchars($_GET["user_id"]);
        $ds_lich = $lichThiRepo->find();
        $hoSo = $hoSoRepo->findById($id);
        $user = $userRepo->findById($id);
    } catch (Exception $e) {
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Xếp lịch</title>
</head>

<body class="bg-gray-100">
    <?php if ($hoSo != null && $user != null): ?>
        <input type="hidden" id="profile-id" value="<?php echo $hoSo->ho_so_id ?>">
        <input type="hidden" id="phone" value="<?php echo $user->phone ?>">

        <div class="container mx-auto mt-10 px-4">
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-5xl mx-auto">
                <h1 class="text-2xl font-bold mb-6 text-center">Lập lịch thi</h1>
                <form>
                    <div class="mb-4">
                        <label for="lich-thi" class="block text-gray-700 font-medium mb-2">Lịch thi:</label>
                        <select id="lich-thi" name="lich-thi" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                            <option value="" disabled selected>-- Chọn lịch thi --</option>
                            <?php foreach ($ds_lich as $lich): ?>
                                <option value="<?php echo $lich->id ?>">
                                    Môn: <?php echo $lich->ten_mon_thi ?> -
                                    Ngày <?php
                                            $timestamp = strtotime($lich->ngay_thi);
                                            echo date("d/m/Y", $timestamp) ?> -
                                    Giờ <?php echo $lich->gio_thi ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex flex-col justify-center items-center space-y-2">
                        <button id="dang-ky-btn" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300 ease-in-out w-full sm:w-auto">
                            Đăng ký
                        </button>
                        <a href="<?php echo Import::view_page_path("manager/resume/page.php"); ?>" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300 ease-in-out w-full sm:w-auto">
                            Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class=" bg-white rounded-lg md:shadow-lg pb-8 mt-4 md:mt-8 md:px-8 md:pt-4 max-w-5xl mx-auto">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Lịch chi tiết</h3>
            <div id="thong-tin-hs"></div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-blue-800">Tên kỳ thi</th>
                            <th class="px-6 py-4 text-left text-blue-800">Tên môn thi</th>
                            <th class="px-6 py-4 text-left text-blue-800">Ngày thi</th>
                            <th class="px-6 py-4 text-left text-blue-800">Giờ</th>
                            <th class="px-6 py-4 text-left text-blue-800">Địa điểm thi</th>
                            <th class="px-4 py-2 text-center">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody id="result-table-body"></tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <section class="max-w-4xl mx-auto bg-white md:shadow-md p-8 rounded-lg mt-6 text-center">
            <h2 class="text-2xl font-bold text-red-600 mb-6">Không Tìm Thấy Thông Tin Đăng Ký</h2>
            <p class="text-lg mb-4">Rất tiếc, chúng tôi không tìm thấy thông tin đăng ký dự thi theo yêu cầu của bạn.</p>
            <p class="text-lg mb-4">Vui lòng kiểm tra lại mã số đăng ký hoặc liên hệ với nhà trường để được hỗ trợ.</p>
            <div class="mt-6">
                <a href="<?php echo Import::view_page_path("manager/resume/page.php"); ?>" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700">
                    Quay lại
                </a>
            </div>
        </section>

    <?php endif; ?>
</body>
<script>
    function xoaLichThiHS(lichThiHSID) {
        $.ajax({
            url: "<?php echo Import::route_path("lichThi.route.php"); ?>",
            method: "POST",
            data: {
                method: "xoa-lich-thi-hs",
                lich_thi_ho_so_id: lichThiHSID,
            },
            success: (res) => {
                const data = JSON.parse(res)
                if(data.status){
                    window.location.reload()
                }
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
            }
        })
    }

    function loadLich() {
        $.ajax({
            url: "<?php echo Import::route_path("lichThi.route.php"); ?>",
            method: "GET",
            data: {
                method: "tra-lich-thi",
                ma_ho_so: $("#profile-id").val().trim(),
                sdt: $("#phone").val().trim()
            },
            success: (res) => {
                const data = JSON.parse(res)

                if (data.status) {
                    $("#thong-tin-hs").html(`
                        <div class="font-semibold py-4">
                            <p class="text-lg text-gray-600 mb-2" id="name">Họ tên thí sinh: ${data.data.thong_tin_ho_so.ho_ten}</p>
                            <p class="text-lg text-blue-600" id="birthdate">Ngày sinh: ${data.data.thong_tin_ho_so.ngay_thang_nam_sinh}</p>
                        </div>`)
                    $("#result-table-body").html(data.data.lich_thi.map(i => {
                        console.log(i);

                        const item = i.lich_thi
                        return `
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 border">${item.ten_ky_thi}</td>
                                <td class="px-6 py-4 border">${item.ten_mon_thi}</td>
                                <td class="px-6 py-4 border">${item.ngay_thi}</td>
                                <td class="px-6 py-4 border">${item.gio_thi}</td>
                                <td class="px-6 py-4 border">${item.dia_diem_thi}</td>
                                <td class="px-4 py-2 text-center">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-all duration-200" onclick="xoaLichThiHS(${i.ho_so_lich_thi_id});">Xóa</button>
                                </td>
                            </tr>
                            `
                    }).join(" "))
                }
            }
        })
    }
    $(() => {
        loadLich()
        $("#dang-ky-btn").click((e) => {
            e.preventDefault();
            $.ajax({
                url: "<?php echo Import::route_path("lichThi.route.php"); ?>",
                method: "POST",
                data: {
                    method: "dat-lich",
                    ma_ho_so: <?php echo $hoSo->ho_so_id ?>,
                    lich_thi_id: $("#lich-thi").val(),
                },
                success: (res) => {
                    const data = JSON.parse(res)
                    if (data.status) {
                        loadLich()
                    }
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
                }
            })
        })
    })
</script>

</html>