<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::middlewares(files_name: ["auth.middleware.php"]);
Import::entities(files_name: ["user.entity.php"]);
AuthMiddleware::hasRoles([UserRole::AdmissionCommittee->name], function () {}, function ($message) {
    header("Location: /src/views/pages/auth/login.php");
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Hồ sơ tuyển sinh</title>
</head>

<body>
    <div>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
            <!-- sidebar  -->
            <?php require Import::view_layout_path("sidebar/admission-committe-sidebar.php"); ?>

            <div class="flex flex-col flex-1 overflow-hidden">
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden pr-2">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <h3 class="text-xl font-medium text-gray-700">Hồ sơ</h3>
                    </div>
                </header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto bg-white p-2 md:p-4 shadow-lg">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full bg-white rounded-lg shadow-lg">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Mã Hồ Sơ</th>
                                        <th class="px-4 py-2 text-left">Chi tiết</th>
                                        <th class="px-4 py-2 text-left">Trạng thái</th>
                                        <th class="px-4 py-2 text-left">Ngày tạo</th>
                                        <th class="px-4 py-2 text-left">Người cập nhật</th>
                                        <th class="px-4 py-2 text-left">Ghi chú</th>
                                        <th class="px-4 py-2 text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                    
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
    function capNhatTrangThai(id) {
        $.ajax({
            url: "<?php echo Import::route_path("hoSo.route.php"); ?>",
            method: "POST",
            data: {
                method: "cap-nhat-trang-thai",
                trangThai: $(`#trang-thai-${id}`).val(),
                trangThaiHoSoId: id,
                ghiChu:$(`#ghi-chu-${id}`).val()
            },
            success: function(response) {                
                const data = JSON.parse(response);
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

    function getAccounts(page) {
        $.ajax({
            url: "<?php echo Import::route_path("hoSo.route.php"); ?>",
            method: "GET",
            data: {
                method: "get-all-trang-thai-hs",
                page: page
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status) {
                    const html = data.data.map((item) => {
                        const date = new Date(item.created_at);
                        return `
                            <tr class="border-t transition-all duration-300 hover:bg-blue-50">
                                <td class="px-4 py-2 text-gray-700">${item.trang_thai_ho_so_id}</td>
                                <td class="px-4 py-2 text-gray-700">
                                   <a href="<?php echo Import::view_page_path("user/admissions/resume-role.php")?>?user_id=${item.trang_thai_ho_so_id}" class="underline hover:text-blue-600" target="_blank">Xem chi tiết</a>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="relative">
                                        <select id="trang-thai-${item.trang_thai_ho_so_id}" class=" w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300 uppercase">
                                            <option ${item.trang_thai_ho_so.toLowerCase() === "yeucauchinh" ? "selected": ""} value="YeuCauChinh">Yêu cầu chỉnh</option>
                                            <option ${item.trang_thai_ho_so.toLowerCase() === "choduyet" ? "selected": ""} value="ChoDuyet">Chờ duyệt</option>
                                            <option ${item.trang_thai_ho_so.toLowerCase() === "daduyet" ? "selected": ""} value="DaDuyet">Đã duyệt</option>
                                            <option ${item.trang_thai_ho_so.toLowerCase() === "tuchoi" ? "selected": ""} value="TuChoi">Từ chối</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-gray-700">${date.getDay()+"-"+(date.getMonth()+1)+"-"+date.getFullYear()}</td>
                                <td class="px-4 py-2 text-gray-700">${item.thong_tin_nguoi_cap_nhat}</td>
                                <td class="px-4 py-2 text-gray-700 m-auto">
                                    <div class="relative">
                                        <textarea class="outline-none border-0 rounded w-full p-2 max-h-40" id="ghi-chu-${item.trang_thai_ho_so_id}">${item.ghi_chu}</textarea>
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-all duration-200" onclick="capNhatTrangThai(${item.trang_thai_ho_so_id});">Lưu</button>
                                </td>
                            </tr>
                        `;
                    })
                    $("#table-data").html(html.join(" "));
                }
            },
        });
    }
    let pageCurrent = 1;
    $(() => {
        getAccounts(pageCurrent)
    })
</script>

</html>