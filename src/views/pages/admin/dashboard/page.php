<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::interfaces(["repository.interface.php"]);
Import::repositories(["user.repository.php"]);
AuthMiddleware::hasRoles([UserRole::Admin->name], function () {}, function ($message) {
    header("Location: /src/views/pages/auth/login.php");
});

$userRepository = new UserRepository();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Quản lý hệ thống</title>
</head>

<body>
    <div>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
            <!-- sidebar  -->
            <?php require Import::view_layout_path("sidebar/admin-sidebar.php"); ?>

            <div class="flex flex-col flex-1 overflow-hidden">
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden pr-2">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <h3 class="text-xl font-medium text-gray-700">Dashboard</h3>
                    </div>
                </header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container px-6 py-2 mx-auto">
                        <div class="mt-4">
                            <div class="flex flex-wrap -mx-6">
                                <!-- tổng số user đang có trong hệ thống -->
                                <!-- sm:w-1/2 xl:w-1/3  -->
                                <div class="w-full px-6 ">
                                    <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                        <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                                            <svg class="w-8 h-8 text-white" viewBox="0 0 28 30" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </div>

                                        <div class="mx-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">
                                                <!-- đếm số user đang có trong hệ thống -->
                                                <?php echo $userRepository->countUser(); ?>
                                            </h4>
                                            <div class="text-gray-500">Người dùng</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col mt-8">
                            <div class="container">
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <!-- Vùng canvas cho biểu đồ -->
                                    <canvas id="barChart" class=""></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>
<script>
    $(() => {
        const data = {
            labels: ['User', 'Cashier', 'Admin', 'Admission Committee', 'Board Of Directors'], // Các nhãn của biểu đồ
            datasets: [{
                label: 'Số lượng', // Nhãn của cột
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Màu nền cột
                borderColor: 'rgba(75, 192, 192, 1)', // Màu viền cột
                borderWidth: 2, // Độ dày của viền cột
                data: [0, 0, 0, 0, 0], // Dữ liệu cột ban đầu
            }]
        };
        // Cấu hình biểu đồ
        const config = {
            type: 'bar', // Loại biểu đồ cột
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true, // Hiển thị tiêu đề
                        text: 'Biểu đồ số lượng theo vai trò' // Tiêu đề biểu đồ
                    }
                },
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true, // Trục Y bắt đầu từ 0
                    }
                }
            }
        };
        const ctx = $('#barChart')[0].getContext('2d'); // Truy xuất canvas bằng jQuery
        const barChart = new Chart(ctx, config);
        // Sự kiện khi bấm nút "Cập nhật biểu đồ"
        function loadDataChart() {
            $.ajax({
                url: "<?php echo Import::route_path("user.route.php"); ?>",
                method: "GET",
                data: {
                    method: "count-each-role"
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    barChart.data.datasets[0].data = [
                        data.data[0].user_count,
                        data.data[0].cashier_count,
                        data.data[0].admin_count,
                        data.data[0].admission_committee_count,
                        data.data[0].board_of_directors_count
                    ];
                    barChart.update(); // Cập nhật biểu 
                }
            })
        }
        loadDataChart();
    });
</script>

</html>