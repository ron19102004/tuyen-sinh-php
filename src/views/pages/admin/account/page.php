<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::middlewares(files_name: ["auth.middleware.php"]);
Import::entities(files_name: ["user.entity.php"]);
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
                </header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto bg-white p-2 md:p-4 shadow-lg">
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
        console.log(id);
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

    function getAccounts() {
        $.ajax({
            url: "<?php echo Import::route_path("user.route.php"); ?>",
            method: "GET",
            data: {
                method: "get-accounts",
                page: 1
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
                                            <option ${item.role.toLowerCase() === "user" ? "selected": ""} value="User">User</option>
                                            <option ${item.role.toLowerCase() === "cashier" ? "selected": ""} value="Cashier">Cashier</option>
                                            <option ${item.role.toLowerCase() === "admin" ? "selected": ""} value="Admin">Admin</option>
                                            <option ${item.role.toLowerCase() === "admissioncommittee" ? "selected": ""} value="AdmissionCommittee">Admission Committee</option>
                                            <option ${item.role.toLowerCase() === "boardofdirectors" ? "selected": ""} value="BoardOfDirectors">Board Of Directors</option>
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
    $(() => {
        getAccounts()
    })
</script>

</html>