<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
AuthMiddleware::hasRoles([UserRole::Cashier->name], function () {}, function ($message) {
    header("Location: /src/views/pages/auth/login.php");
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Hồ sơ thanh toán</title>
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
                        <h3 class="text-xl font-medium text-gray-700">Hồ sơ</h3>
                    </div>
                    <div class="flex justify-between items-center space-x-4">
                        <button class="px-2 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 hidden" id="prev-btn">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <button class="px-2 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300" id="next-btn">
                            <i class="fas fa-arrow-right"></i>
                        </button>
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
                                        <th class="px-4 py-2 text-left">Số tiền</th>
                                        <th class="px-4 py-2 text-left">Ngày thanh toán</th>
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
                method: "cap-nhat-trang-thai-thanh-toan",
                thanhToanHoSoId: id,
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status) {
                    $(`#trang-thai-${id}`).html("Đã thanh toán");
                    $(`#btn-xac-nhan-${id}`).addClass("hidden")
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

    function getAccounts(page) {
        $.ajax({
            url: "<?php echo Import::route_path("hoSo.route.php"); ?>",
            method: "GET",
            data: {
                method: "get-all-thanh-toan-hs",
                page: page
            },
            success: function(response) {
                const data = JSON.parse(response);
                console.log(data);

                if (data.status) {
                    const html = data.data.map((item) => {
                        let date = undefined;
                        if (item.ngay_thanh_toan) {
                            date = new Date(item.ngay_thanh_toan);
                            date = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
                        }
                        return `
                            <tr class="border-t transition-all duration-300 hover:bg-blue-50">
                                <td class="px-4 py-2 text-gray-700">${item.thanh_toan_ho_so_id}</td>
                                <td class="px-4 py-2 text-gray-700">
                                   <a href="<?php echo Import::view_page_path("user/admissions/resume-role.php") ?>?user_id=${item.thanh_toan_ho_so_id}" class="underline hover:text-blue-600" target="_blank">Xem chi tiết</a>
                                </td>
                                <td class="px-4 py-2" id="trang-thai-${item.thanh_toan_ho_so_id}">
                                    ${item.trang_thai_thanh_toan === 0 ? "Chưa thanh toán": "Đã thanh toán"}
                                </td>
                                <td class="px-4 py-2 text-gray-700">${item.so_tien} VNĐ</td>
                                <td class="px-4 py-2 text-gray-700">${date}</td>
                                <td class="px-4 py-2 text-center">
                                    <button id="btn-xac-nhan-${item.thanh_toan_ho_so_id}" class="${item.trang_thai_thanh_toan === 0 ? "bg-blue-600": "hidden"}  text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-all duration-200" onclick="capNhatTrangThai(${item.thanh_toan_ho_so_id});">Xác nhận thanh toán</button>
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
        $("#prev-btn").click(()=>{
            pageCurrent --;
            getAccounts(pageCurrent)
            if(pageCurrent === 1){
                $("#prev-btn").addClass("hidden")
            }
        })
        $("#next-btn").click(()=>{
            pageCurrent ++;
            getAccounts(pageCurrent)
            if(pageCurrent > 1){
                $("#prev-btn").removeClass("hidden")
            }
        })
    })
</script>

</html>