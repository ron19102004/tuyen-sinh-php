<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full text-center">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Quên mật khẩu?</h1>
        <p class="text-gray-600 mb-6">
            Nếu bạn quên mật khẩu, vui lòng liên hệ với Admin để được hỗ trợ đặt lại mật khẩu.
        </p>
        <button 
            class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:outline-none transition duration-200 ease-in-out" 
            onclick="contactAdmin()">
            <i class="fas fa-envelope mr-2"></i>Liên hệ Admin
        </button>

        <p class="mt-4 text-gray-500 text-sm">Admin sẽ giúp bạn khôi phục mật khẩu trong thời gian sớm nhất.</p>
    </div>

    <script>
        function contactAdmin() {
            alert("Vui lòng liên hệ Admin qua email admin@example.com hoặc số điện thoại 0123456789.");
        }
    </script>

</body>
</html>
