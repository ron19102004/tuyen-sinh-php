<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::entities(["user.entity.php", "trangThaiHoSo.entity.php"]);
Import::interfaces(["repository.interface.php"]);
Import::repositories(["trangThaiHoSo.repository.php"]);
Import::middlewares(files_name: ["auth.middleware.php"]);
AuthMiddleware::isAuthenticated(fn() => null, function () {
    header("Location: /src/views/pages/auth/login.php");
});
$trangThaiHoSoRepo = new TrangThaiHoSoRepository();
$tonTaiTrangThai = $trangThaiHoSoRepo->findById(Session::get("user_id"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Tài khoản của tôi</title>
</head>

<body>
    <!-- header -->
    <?php require Import::view_layout_path("header/user-header.php") ?>
    <!-- main content -->
    <div class="md:p-5">
        <div class="bg-white max-w-5xl mx-auto md:shadow-lg overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-blue-800">
                <h3 class="text-lg leading-6 font-medium text-gray-100">
                    Thông tin tài khoản
                </h3>
                <p class="mt-1 max-w-5xl text-sm text-gray-200">
                    Chi tiết và thông tin của người dùng
                </p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Họ và tên
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2" id="fullName">
                            Unknown
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Tên đăng nhập
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2" id="username">
                            Unknown
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Địa chỉ email
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2" id="email">
                            Unknown
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Số điện thoại
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2" id="phone">
                            Unknown
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Vai trò <span class="italic">(Nhấn vào nếu bạn có vai trò trong hệ thống)</span>
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2" id="role">
                            Unknown
                        </dd>
                    </div>
                    <?php if ($tonTaiTrangThai != null): ?>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Hồ sơ của tôi
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2" id="phone">
                                <a href="<?php echo Import::view_page_path("user/admissions/resume.php")?>" class="underline hover:text-blue-600" target="_blank">Xem chi tiết</a>
                            </dd>
                        </div>
                    <?php endif; ?>
                </dl>
            </div>
        </div>
    </div>
    <?php if ($tonTaiTrangThai != null): ?>
        <!-- trạng thái hồ sơ  -->
        <div class=" bg-white rounded-lg md:shadow-lg md:pb-6 md:px-6  max-w-5xl mx-auto md:mb-5">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Trạng thái hồ sơ</h3>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="bg-blue-800">
                        <tr>
                            <th class="px-6 py-4 text-left text-white">Mã hồ sơ</th>
                            <th class="px-6 py-4 text-left text-white">Trạng thái</th>
                            <th class="px-6 py-4 text-left text-white">Ngày tạo</th>
                            <th class="px-6 py-4 text-left text-white">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Ví dụ -->
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 border"><?php echo $tonTaiTrangThai->trang_thai_ho_so_id; ?></td>
                            <td class="px-6 py-4 border font-bold
                            <?php
                            switch ($tonTaiTrangThai->trang_thai_ho_so) {
                                case TrangThaiHoSoEnum::ChoDuyet->name: {
                                        echo "text-gray-500";
                                        break;
                                    }
                                case TrangThaiHoSoEnum::DaDuyet->name: {
                                        echo "text-green-600";
                                        break;
                                    }
                                case TrangThaiHoSoEnum::TuChoi->name: {
                                        echo "text-red-500";
                                        break;
                                    }
                                case TrangThaiHoSoEnum::YeuCauChinh->name: {
                                        echo "text-[#ffd633]";
                                        break;
                                    }
                            }
                            ?>"><?php echo TrangThaiHoSo::toVNStringEnum($tonTaiTrangThai->trang_thai_ho_so); ?></td>
                            <td class="px-6 py-4 border">
                                <?php
                                $date = new DateTime($tonTaiTrangThai->created_at);
                                echo $date->format('d/m/Y');
                                ?>
                            </td>
                            <td class="px-6 py-4 border"><?php echo $tonTaiTrangThai->ghi_chu; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
    <!-- footer -->
    <?php include Import::view_layout_path("footer/user-footer.php") ?>
</body>
<script>
    $(() => {
        const url = "<?php echo Import::route_path("auth.route.php"); ?>";
        $.ajax({
            url: url,
            method: "POST",
            data: {
                method: "me"
            },
            success: (res) => {
                console.log(res);

                const data = JSON.parse(res);
                if (data.status) {
                    $("#fullName").text(data.data.fullName);
                    $("#username").text(data.data.username);
                    $("#email").text(data.data.email);
                    $("#phone").text(data.data.phone);
                    $("#role").html(`
                    <a class="hover:text-blue-600" 
                    href="<?php
                            switch (Session::get("user_role")) {
                                case UserRole::Admin->name: {
                                        echo Import::view_page_path("admin/dashboard/page.php");
                                        break;
                                    }
                                case UserRole::AdmissionCommittee->name:{
                                     echo Import::view_page_path("admission-committe/dashboard/page.php");
                                        break;
                                }
                            }
                            ?>">${data.data.role}</a>
                    `);
                }
            }
        })
    })
</script>

</html>