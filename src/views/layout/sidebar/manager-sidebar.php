<?php
$roleCurrent = AuthMiddleware::getRoleCurrent();
?>
<div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <span class="mx-2 text-2xl font-semibold text-white">BAN ĐIỀU HÀNH</span>
        </div>
    </div>
    <nav class="mt-10">
        <a class="flex items-center px-6 py-4 mt-4 text-gray-100 bg-opacity-25  <?php echo isActiveLink("manager/dashboard/page.php") ? "bg-gray-700 " : "hover:bg-gray-700 "; ?>" href="<?php echo Import::view_page_path("manager/dashboard/page.php"); ?>">
            <i class="fa-solid fa-house"></i>
            <span class="mx-3">Dashboard</span>
        </a>
        <?php if ($roleCurrent == UserRole::AdmissionCommittee->name || $roleCurrent == UserRole::BoardOfDirectors->name): ?>
            <a class="flex items-center px-6 py-4 mt-4 text-gray-100 bg-opacity-25  <?php echo isActiveLink("manager/resume/page.php") ? "bg-gray-700 " : "hover:bg-gray-700 "; ?>" href="<?php echo Import::view_page_path("manager/resume/page.php"); ?>">
                <i class="fa-solid fa-user"></i>
                <span class="mx-3">Hồ sơ</span>
            </a>
            <a class="flex items-center px-6 py-4 mt-4 text-gray-100 bg-opacity-25  <?php echo isActiveLink("manager/score/page.php") ? "bg-gray-700 " : "hover:bg-gray-700 "; ?>" href="<?php echo Import::view_page_path("manager/score/page.php"); ?>">
                <i class="fa-solid fa-plus"></i>
                <span class="mx-3">Điểm số</span>
            </a>
        <?php else: ?>
            <a class="flex items-center px-6 py-4 mt-4 text-gray-100 bg-opacity-25  <?php echo isActiveLink("manager/cashier/page.php") ? "bg-gray-700 " : "hover:bg-gray-700 "; ?>" href="<?php echo Import::view_page_path("manager/cashier/page.php"); ?>">
                <i class="fa-solid fa-user"></i>
                <span class="mx-3">Thanh toán</span>
            </a>
        <?php endif; ?>

        <?php if ($roleCurrent == UserRole::BoardOfDirectors->name): ?>
            <a class="flex items-center px-6 py-4 mt-4 text-gray-100 bg-opacity-25  <?php echo isActiveLink("manager/schedule/page.php") ? "bg-gray-700 " : "hover:bg-gray-700 "; ?>" href="<?php echo Import::view_page_path("manager/schedule/page.php"); ?>">
                <i class="fa-solid fa-calendar-days"></i>
                <span class="mx-3">Lịch thi</span>
            </a>
        <?php endif; ?>
        <button id="logout-btn" class="flex items-center px-6 py-4 mt-4 text-gray-100 bg-opacity-25  hover:bg-gray-700 w-full" href="#">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span class="mx-3">Đăng xuất</span>
        </button>
    </nav>
</div>
<script>
    $(() => {
        $("#logout-btn").click(() => {
            const url = "<?php echo Import::route_path("auth.route.php"); ?>"
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    method: "logout"
                },
                success: function(response) {
                    window.location.href = "<?php echo Env::get("server"); ?>";
                }
            })
        })
    })
</script>