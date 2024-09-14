<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
AuthMiddleware::hasRoles([UserRole::Admin->name], function () {}, function ($message) {
    header("Location: /src/views/pages/auth/login.php");
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Tài khoản người dùng - Admin</title>
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
                        <h3 class="text-xl font-medium text-gray-700">Tài khoản</h3>
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
                    <div class="container mx-auto bg-white p-2 md:p-4 shadow-lg space-y-2">
                        <h1>
                            <span class="bg-[#fed014] px-2 py-1 text-blue-800 font-bold">Chú ý:</span>
                            <span>Mật khẩu mới sẽ có dạng username#id#*</span>
                        </h1>
                        <div class="my-6 flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 bg-white shadow-xl rounded-lg">
                            <div class="md:w-1/2">
                                <label for="role-filter" class="block text-sm font-medium text-gray-800 mb-2">
                                    Lọc theo vai trò
                                </label>
                                <div class="relative">
                                    <select id="role-filter" class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out">
                                        <option value="0" selected>Chọn bộ lọc / hủy lọc</option>
                                        <option value="Admin">ADMIN</option>
                                        <option value="User">NGƯỜI DÙNG</option>
                                        <option value="Cashier">THU NGÂN</option>
                                        <option value="AdmissionCommittee">BAN TUYỂN SINH</option>
                                        <option value="BoardOfDirectors">BAN GIÁM HIỆU</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4M16 15l-4 4-4-4"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table-auto w-full bg-white rounded-lg shadow-lg">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left">ID</th>
                                        <th class="px-4 py-2 text-left">Username</th>
                                        <th class="px-4 py-2 text-left">Email</th>
                                        <th class="px-4 py-2 text-left">Họ và tên</th>
                                        <th class="px-4 py-2 text-left">Số điện thoại</th>
                                        <th class="px-4 py-2 text-left">Vai trò</th>
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
    function resetPassword(id) {
        $.ajax({
            url: "<?php echo Import::route_path("auth.route.php"); ?>",
            method: "POST",
            data: {
                method: "resetPassword",
                user_id: id,
            },
            success: (res) => {
                const data = JSON.parse(res);
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
    /**
     * @param {number} id
     */
    function saveInfo(id) {
        const role = $(`#role-${id}`).val();
        $.ajax({
            url: "<?php echo Import::route_path("user.route.php"); ?>",
            method: "POST",
            data: {
                method: "update-role",
                id: id,
                role: role
            },
            success: function(response) {
                console.log(response);
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
            url: "<?php echo Import::route_path("user.route.php"); ?>",
            method: "GET",
            data: {
                method: "get-accounts",
                page: page,
                role_filter: $("#role-filter").val()
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status) {
                    const html = data.data.map((item) => {
                        return `
                            <tr class="border-t transition-all duration-300 hover:bg-blue-50">
                                <td class="px-4 py-2 text-gray-700">${item.id}</td>
                                <td class="px-4 py-2 text-gray-700">${item.username}</td>
                                <td class="px-4 py-2 text-gray-700">${item.email}</td>
                                <td class="px-4 py-2 text-gray-700">${item.fullName}</td>
                                <td class="px-4 py-2 text-gray-700">${item.phone}</td>
                                <td class="px-4 py-2">
                                    <div class="relative">
                                        <select id="role-${item.id}" class=" w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300 uppercase">
                                            <option ${item.role.toLowerCase() === "user" ? "selected": ""} value="User">Người dùng</option>
                                            <option ${item.role.toLowerCase() === "cashier" ? "selected": ""} value="Cashier">Thu ngân</option>
                                            <option ${item.role.toLowerCase() === "admin" ? "selected": ""} value="Admin">Admin</option>
                                            <option ${item.role.toLowerCase() === "admissioncommittee" ? "selected": ""} value="AdmissionCommittee">Ban tuyển sinh</option>
                                            <option ${item.role.toLowerCase() === "boardofdirectors" ? "selected": ""} value="BoardOfDirectors">Ban giám hiệu</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-center flex">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-red-600 transition-all duration-200" onclick="resetPassword(${item.id});">Reset mật khẩu</button>
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-all duration-200" onclick="saveInfo(${item.id});">Lưu</button>
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
        $("#prev-btn").click(() => {
            pageCurrent--;
            getAccounts(pageCurrent)
            if (pageCurrent === 1) {
                $("#prev-btn").addClass("hidden")
            }
        })
        $("#next-btn").click(() => {
            pageCurrent++;
            getAccounts(pageCurrent)
            if (pageCurrent > 1) {
                $("#prev-btn").removeClass("hidden")
            }
        })
        $("#role-filter").change((e) => {
            getAccounts(pageCurrent)
        })
    })
</script>

</html>