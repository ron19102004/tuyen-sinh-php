<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Tra cứu kết quả xét tuyển</title>
</head>

<body>
    <!-- header -->
    <?php require Import::view_layout_path("header/user-header.php") ?>
    <!-- main  -->
    <div class="bg-blue-800 md:shadow-lg py-5">
        <div class="container mx-auto px-4">
            <h1 class="text-white text-3xl font-bold text-center">Tra cứu kết quả xét tuyển</h1>
        </div>
    </div>

    <!-- Main content -->
    <main class="container mx-auto px-4 py-8 flex-grow">
        <div class="bg-white rounded-lg md:shadow-xl p-8 max-w-xl mx-auto">
            <h2 class="text-2xl font-semibold mb-6 text-center text-gray-800">Nhập thông tin để tra cứu</h2>

            <form class="space-y-6">
                <!-- Mã hồ sơ -->
                <div>
                    <label for="profile-id" class="block text-gray-700 font-medium">Mã hồ sơ</label>
                    <input type="text" id="profile-id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition duration-300" placeholder="Nhập mã hồ sơ">
                </div>

                <!-- Số điện thoại -->
                <div>
                    <label for="phone" class="block text-gray-700 font-medium">Số điện thoại</label>
                    <input type="text" id="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition duration-300" placeholder="Nhập số điện thoại">
                </div>

                <!-- Nút tra cứu -->
                <div class="text-center">
                    <button type="submit" id="lookup" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Tra cứu</button>
                </div>
            </form>
        </div>

        <!-- Kết quả tra cứu -->
        <div class="md:mt-8 bg-white rounded-lg md:shadow-lg pb-8 md:px-8 max-w-5xl mx-auto">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Kết quả tra cứu</h3>
            <div id="thong-tin-hs"></div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-blue-800">Điểm toán</th>
                            <th class="px-6 py-4 text-left text-blue-800">Điểm văn</th>
                            <th class="px-6 py-4 text-left text-blue-800">Điểm ngoại ngữ</th>
                            <th class="px-6 py-4 text-left text-blue-800">Điểm môn chuyên</th>
                        </tr>
                    </thead>
                    <tbody id="result-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- footer -->
    <?php include Import::view_layout_path("footer/user-footer.php") ?>
</body>
<script>
    $(() => {
        $("#lookup").click((e) => {
            e.preventDefault()
            $.ajax({
                url: "<?php echo Import::route_path("ketQuaThiTuyen.route.php"); ?>",
                method: "GET",
                data: {
                    method: "tra-cuu-diem",
                    ma_ho_so: $("#profile-id").val().trim(),
                    sdt: $("#phone").val().trim()
                },
                success: (res) => {
                    const data = JSON.parse(res)
                    console.log(data);
                    
                    if (data.status) {
                        $("#thong-tin-hs").html(`
                        <div class="font-semibold py-4">
                            <p class="text-lg text-gray-600 mb-2" id="name">Họ tên thí sinh: ${data.data.thong_tin.ho_ten}</p>
                            <p class="text-lg text-blue-600" id="birthdate">Ngày sinh: ${data.data.thong_tin.ngay_thang_nam_sinh}</p>
                        </div>`)
                        $("#result-table-body").html(`
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 border">${data.data.ket_qua.diem_toan}</td>
                                <td class="px-6 py-4 border">${data.data.ket_qua.diem_van}</td>
                                <td class="px-6 py-4 border">${data.data.ket_qua.diem_ngoai_ngu}</td>
                                <td class="px-6 py-4 border">${data.data.ket_qua.diem_mon_chuyen}</td>
                            </tr>`)
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