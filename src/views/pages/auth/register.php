<?php require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php"); 
if (AuthMiddleware::isAuth()) {
    header("Location: /");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(Import::view_layout_path("head.php")) ?>
    <title>Đăng ký tài khoản</title>
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
            <h2 class="mb-4 text-center text-3xl font-bold text-gray-700">Đăng ký tài khoản</h2>
            <form>
                <div class="mb-1">
                    <label class="block mb-1" for="fullName">Họ và tên</label>
                    <input id="fullName" type="text" name="fullName" class="p-3 border border-gray-300  focus:outline-none focus:ring   focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
                </div>
                <div class="mb-1">
                    <label class="block mb-1" for="username">Tên tài khoản</label>
                    <input id="username" type="text" name="username" class="p-3 border border-gray-300  focus:outline-none focus:ring   focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
                </div>
                <div class="mb-1">
                    <label class="block mb-1" for="email">Địa chỉ email</label>
                    <input id="email" type="email" name="email" class="p-3 border border-gray-300  focus:outline-none focus:ring   focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
                </div>
                <div class="mb-1">
                    <label class="block mb-1" for="phone">Số điện thoại</label>
                    <input id="phone" type="tel" name="phone" class="p-3 border border-gray-300  focus:outline-none focus:ring   focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
                </div>
                <div class="mb-1">
                    <label class="block mb-1" for="password">Mật khẩu</label>
                    <input id="password" type="password" name="password" class="p-3  border border-gray-300  focus:outline-none focus:ring  focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
                </div>
                <div class="mt-6">
                    <button class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold capitalize text-white hover:bg-red-700 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring   disabled:opacity-25 transition" id="submit">Xác thực</button>
                </div>
                <div class="mt-6 text-center">
                    <a href="./login.php" class="underline">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const vnPhoneRegex = /^(0|\+84)(3|5|7|8|9)[0-9]{8}$/;

    $(() => {
        $("#submit").click(async (e) => {
            e.preventDefault()
            const url = "<?php echo Import::route_path("auth.route.php"); ?>"
            const username = $("#username").val()
            const password = $("#password").val()
            const phone = $("#phone").val()
            const email = $("#email").val()
            const fullName = $("#fullName").val()

            if (!username || !password || !phone || !email || !fullName) {
                Toastify({
                    text: "Tất cả các trường không được trống",
                    duration: 2000,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#cc2121",
                    },
                }).showToast();
                return;
            }
            if (!emailRegex.test(email)) {
                Toastify({
                    text: "Email không hợp lệ",
                    duration: 2000,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#cc2121",
                    },
                }).showToast();
                return;
            }
            if (!vnPhoneRegex.test(phone)) {
                Toastify({
                    text: "Số điện thoại không hợp lệ",
                    duration: 2000,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#cc2121",
                    },
                }).showToast();
                return;
            }
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    method: "register",
                    username: username,
                    password: password,
                    email: email,
                    phone: phone,
                    fullName: fullName
                },
                success: (res) => {
                    console.log(res);

                    const data = JSON.parse(res);
                    
                    Toastify({
                        text: data.message,
                        duration: 2000,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: data.status ? "green" : "#cc2121",
                        },
                    }).showToast();
                    if (data.status) {
                        setTimeout(() => {
                            window.location.href = "./login.php";
                        }, 2000)
                    }
                }
            })
        })
    })
</script>

</html>