<?php require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php");
Import::middlewares(files_name: ["auth.middleware.php"]);
if (AuthMiddleware::isAuth()) {
    header("Location: /");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(Import::view_layout_path("head.php")) ?>
    <title>Đăng nhập</title>
</head>

<body>
    <div class="md:fixed min-w-screen p-2 md:px-10 md:py-4 bg-gray-50">
        <a href="/" class="flex items-center w-full">
            <img src="<?php echo Env::get("system")["logo"]; ?>" alt="banner" class="h-10 md:h-16 w-fit object-cover">
            <h1 class="flex flex-col text-gray-800">
                <span>Trường THPT Chuyên </span>
                <span class="font-semibold"><?php echo Env::get("system")["name"]; ?></span>
            </h1>
        </a>
    </div>
    <div class="w-full min-h-screen bg-gray-50 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md p-5 mx-auto">
            <h2 class="mb-12 text-center text-5xl font-bold text-gray-700">Đăng nhập</h2>
            <form>
                <div class="mb-4">
                    <label class="block mb-1" for="email">Địa chỉ email</label>
                    <input id="username" type="text" class="p-3 border border-gray-300  focus:outline-none focus:ring   focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
                </div>
                <div class="mb-4">
                    <label class="block mb-1" for="password">Mật khẩu</label>
                    <input type="password" id="password" class="p-3  border border-gray-300  focus:outline-none focus:ring  focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
                </div>
                <div class="mt-6 flex items-center justify-end">
                    <a href="#" class="text-sm"> Quên mật khẩu? </a>
                </div>
                <div class="mt-6">
                    <button class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold capitalize text-white hover:bg-red-700 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring   disabled:opacity-25 transition" id="submit">Xác thực</button>
                </div>
                <div class="mt-6 text-center">
                    <a href="./register.php" class="underline">Tạo tài khoản</a>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    $(() => {
        $("#submit").click(async (e) => {
            e.preventDefault()
            const url = "<?php echo Import::route_path("auth.route.php"); ?>"
            const username = $("#username").val()
            const password = $("#password").val()
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    method: "login",
                    username: username,
                    password: password
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
                    if (data.status) {
                        window.location.href = "<?php echo Env::get("server"); ?>";
                    }
                }
            })
        })
    })
</script>

</html>