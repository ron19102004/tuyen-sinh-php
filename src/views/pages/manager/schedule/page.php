<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::interfaces(["repository.interface.php"]);
Import::entities(["lichThi.entity.php"]);
Import::repositories(["lichThi.repository.php"]);
AuthMiddleware::hasRoles([
    UserRole::AdmissionCommittee->name,
    UserRole::BoardOfDirectors->name
], function () {}, function ($message) {
    header("Location: /src/views/pages/auth/login.php");
});
$lichThiRepo = new LichThiRepository();
$ds_lich = $lichThiRepo->find();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Lịch thi</title>
</head>

<body>
    <div>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
            <!-- sidebar  -->
            <?php require Import::view_layout_path("sidebar/manager-sidebar.php"); ?>

            <div class="flex flex-col flex-1 overflow-hidden">
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden pr-2">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <h3 class="text-xl font-medium text-gray-700">Lịch thi</h3>
                    </div>

                    <div class="flex justify-between items-center space-x-4">
                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-2 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Thêm lịch
                        </button>
                    </div>
                </header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <!-- Main modal -->
                    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="max-w-2xl mx-auto p-8 mt-10 bg-white shadow-md rounded-lg">
                            <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Thêm Lịch Thi</h2>
                            <form>
                                <!-- Tên Kỳ Thi -->
                                <div class="mb-4">
                                    <label for="ten_ky_thi" class="block text-sm font-medium text-gray-700">Tên Kỳ Thi</label>
                                    <input type="text" id="ten_ky_thi" name="ten_ky_thi" class="md:w-96 mt-1 block  border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
                                </div>

                                <!-- Tên Môn Thi -->
                                <div class="mb-4">
                                    <label for="ten_mon_thi" class="block text-sm font-medium text-gray-700">Tên Môn Thi</label>
                                    <input type="text" id="ten_mon_thi" name="ten_mon_thi" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
                                </div>

                                <!-- Ngày Thi -->
                                <div class="mb-4">
                                    <label for="ngay_thi" class="block text-sm font-medium text-gray-700">Ngày Thi</label>
                                    <input type="date" id="ngay_thi" name="ngay_thi" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
                                </div>

                                <!-- Địa Điểm Thi -->
                                <div class="mb-4">
                                    <label for="dia_diem_thi" class="block text-sm font-medium text-gray-700">Địa Điểm Thi</label>
                                    <textarea id="dia_diem_thi" name="dia_diem_thi" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                                </div>

                                <!-- Giờ Thi -->
                                <div class="mb-4">
                                    <label for="gio_thi" class="block text-sm font-medium text-gray-700">Giờ Thi</label>
                                    <input type="time" id="gio_thi" name="gio_thi" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-center">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" id="them-lich-btn">Thêm Lịch Thi</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="container mx-auto bg-white p-2 md:p-4 shadow-lg">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full bg-white rounded-lg shadow-lg">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Mã lịch</th>
                                        <th class="px-4 py-2 text-left">Tên kỳ thi</th>
                                        <th class="px-4 py-2 text-left">Tên môn thi</th>
                                        <th class="px-4 py-2 text-left">Ngày thi</th>
                                        <th class="px-4 py-2 text-left">Giờ thi</th>
                                        <th class="px-4 py-2 text-left">Địa điểm thi</th>
                                        <th class="px-4 py-2 text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                    <?php foreach ($ds_lich as $lich): ?>
                                        <tr class="border-t transition-all duration-300 hover:bg-blue-50">
                                            <td class="px-4 py-2 text-center"> <?php echo $lich->id ?></td>
                                            <td class="px-4 py-2 text-center"> <?php echo $lich->ten_ky_thi ?></td>
                                            <td class="px-4 py-2 text-center"> <?php echo $lich->ten_mon_thi ?></td>
                                            <td class="px-4 py-2 text-center">
                                                <?php
                                                $timestamp = strtotime($lich->ngay_thi);
                                                echo date("d/m/Y", $timestamp) ?>
                                            </td>
                                            <td class="px-4 py-2 text-center"> <?php echo $lich->gio_thi ?></td>
                                            <td class="px-4 py-2 text-center"> <?php echo $lich->dia_diem_thi ?></td>
                                            <td class="px-4 py-2 text-center">
                                                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-all duration-200" onclick="xoaLich('<?php echo $lich->id ?>');">Xóa</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>
<script>
    /**
     * @param {number} id
     */
    function xoaLich(id) {
        $.ajax({
            url: "<?php echo Import::route_path("lichThi.route.php"); ?>",
            method: "POST",
            data: {
                method: "xoa-lich-thi",
                lich_thi_id: id,
            },
            success: function(response) {
                const data = JSON.parse(response);
                if(data.status){
                    window.location.reload();
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
    $(() => {
        $("#them-lich-btn").click((e) => {
            e.preventDefault();
            var tenKyThi = $('#ten_ky_thi').val();
            var tenMonThi = $('#ten_mon_thi').val();
            var ngayThi = $('#ngay_thi').val();
            var diaDiemThi = $('#dia_diem_thi').val();
            var gioThi = $('#gio_thi').val();
            // them-lich-thi
            $.ajax({
                url: "<?php echo Import::route_path("lichThi.route.php"); ?>",
                method: "POST",
                data: {
                    method: "them-lich-thi",
                    ten_ky_thi: tenKyThi,
                    ten_mon_thi: tenMonThi,
                    ngay_thi: ngayThi,
                    dia_diem_thi: diaDiemThi,
                    gio_thi: gioThi
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if(data.status){
                        window.location.reload();
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