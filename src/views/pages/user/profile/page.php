<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::middlewares(files_name: ["auth.middleware.php"]);
Import::entities(files_name: ["user.entity.php"]);
AuthMiddleware::isAuthenticated(function () {});
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
    <input type="text" hidden id="url" value="<?php echo Import::route_path("auth.route.php"); ?>">
    <div class="md:p-5">
        <div class="bg-white max-w-2xl mx-auto shadow-lg overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Thông tin tài khoản
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
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
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Vai trò
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2" id="role">
                            Unknown
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php include Import::view_layout_path("footer/user-footer.php") ?>
</body>
<script>
    $(() => {
        const url = $("#url").val();
        $.ajax({
            url: url,
            method: "POST",
            data: {
                method: "me"
            },
            success: (res) => {
                console.log(res);
                
                const data = JSON.parse(res);                
                if(data.status){
                    $("#fullName").text(data.data.fullName);
                    $("#username").text(data.data.username);
                    $("#email").text(data.data.email);
                    $("#phone").text(data.data.phone);
                    $("#role").text(data.data.role);
                }
            }
        })
    })
</script>

</html>