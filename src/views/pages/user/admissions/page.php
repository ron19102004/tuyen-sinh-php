<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Tuyển sinh</title>
</head>

<body class="transition-all">
    <!-- header -->
    <?php require Import::view_layout_path("header/user-header.php") ?>
    <!-- main content -->
    <div class="bg-blue-800 text-white py-6 shadow-lg">
        <div class="container mx-auto text-center px-4">
            <h1 class="text-4xl font-bold md:text-5xl">Tuyển Sinh Trường chuyên <?php echo Env::get("system")["name"]?></h1>
            <p class="mt-2 text-lg">Nơi ươm mầm tài năng tương lai</p>
        </div>
    </div>

    <!-- Hình ảnh minh họa -->
    <section data-aos="fade-up" class="container mx-auto my-10 px-6">
        <div class="w-full flex justify-center">
            <img src="<?php echo Import::view_assets_path("anh-truong-le-hong-phong.jpeg") ?>" alt="Hình ảnh trường học" class="rounded-lg shadow-lg max-w-full md:h-[500px] md:w-[1200px] object-cover">
        </div>
    </section>

    <!-- Chương trình đào tạo -->
    <section class="container mx-auto my-12 px-6">
        <h2 class="text-3xl font-bold text-center mb-10 text-blue-00">Chương trình đào tạo</h2>

        <!-- Các khối chuyên -->
        <div class="mb-16">
            <h3 class="text-2xl font-semibold mb-6">Các khối chuyên</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div data-aos="fade-up" class="p-6 bg-white shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                    <img src="<?php echo Import::view_assets_path("math.png");?>" alt="Toán học" class="rounded-md mb-4 h-40 w-full object-cover">
                    <h4 class="font-bold text-blue-800 text-lg">Toán</h4>
                    <p class="mt-2 text-gray-600">Chương trình học chuyên sâu về Toán học, hướng tới các kỳ thi quốc gia và quốc tế.</p>
                </div>
                <div data-aos="fade-up" class="p-6 bg-white shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                    <img src="<?php echo Import::view_assets_path(file_name: "physics.png");?>" alt="Vật lý" class="rounded-md mb-4 h-40 w-full object-cover">
                    <h4 class="font-bold text-blue-800 text-lg">Lý</h4>
                    <p class="mt-2 text-gray-600">Đào tạo chuyên sâu về Vật lý với các bài giảng và thực hành nghiên cứu.</p>
                </div>
                <div data-aos="fade-up" class="p-6 bg-white shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                    <img src="<?php echo Import::view_assets_path(file_name: "chemistry.jpg");?>" alt="Hóa học" class="rounded-md mb-4 h-40 w-full object-cover">
                    <h4 class="font-bold text-blue-800 text-lg">Hóa</h4>
                    <p class="mt-2 text-gray-600">Chuyên về Hóa học, với các phòng thí nghiệm hiện đại phục vụ nghiên cứu.</p>
                </div>
                <div data-aos="fade-up" class="p-6 bg-white shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                    <img src="<?php echo Import::view_assets_path(file_name: "english.jpg");?>" alt="Tiếng Anh" class="rounded-md mb-4 h-40 w-full object-cover">
                    <h4 class="font-bold text-blue-800 text-lg">Anh</h4>
                    <p class="mt-2 text-gray-600">Tập trung vào khả năng giao tiếp, ngữ pháp và văn hóa ngôn ngữ Anh.</p>
                </div>
                <div data-aos="fade-up" class="p-6 bg-white shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                    <img src="<?php echo Import::view_assets_path(file_name: "literature.jpg");?>" alt="Ngữ văn" class="rounded-md mb-4 h-40 w-full object-cover">
                    <h4 class="font-bold text-blue-800 text-lg">Văn</h4>
                    <p class="mt-2 text-gray-600">Chương trình học chuyên sâu về Ngữ văn và các tác phẩm văn học kinh điển.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Hướng dẫn đăng ký -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-6">
            <h2 data-aos="fade-up" class="text-3xl font-bold text-center mb-10 text-blue-600">Hướng dẫn đăng ký</h2>

            <!-- Quy trình đăng ký -->
            <div data-aos="fade-up" class="mb-12">
                <h3 class="text-2xl font-semibold mb-4">Quy trình đăng ký trực tuyến hoặc nộp hồ sơ trực tiếp</h3>
                <p class="text-gray-600 mb-6">Học sinh có thể chọn một trong hai hình thức đăng ký:</p>
                <ul class="list-disc list-inside text-gray-600 space-y-2">
                    <li><strong>Trực tuyến:</strong> Truy cập vào
                        <a href="./registration-form.php" class="underline">đây</a>
                        để đăng ký, điền đầy đủ thông tin và nộp hồ sơ.
                    </li>
                    <li><strong>Nộp trực tiếp:</strong> Đến văn phòng tuyển sinh của trường để nhận và nộp hồ sơ trực tiếp.</li>
                </ul>
            </div>

            <!-- Biểu mẫu đăng ký -->
            <div data-aos="fade-up" class="mb-12">
                <h3 class="text-2xl font-semibold mb-4">Biểu mẫu đăng ký và hướng dẫn điền thông tin</h3>
                <p class="text-gray-600">Biểu mẫu đăng ký bao gồm các mục thông tin cá nhân, lựa chọn khối chuyên, và thông tin liên hệ của phụ huynh. Vui lòng điền đầy đủ và chính xác các thông tin trước khi nộp.</p>
            </div>

            <!-- Phí tuyển sinh -->
            <div data-aos="fade-up">
                <h3 class="text-2xl font-semibold mb-4">Phí tuyển sinh</h3>
                <p class="text-gray-600">Phí tuyển sinh là <strong>200.000 VNĐ</strong>, nộp cùng với hồ sơ đăng ký trực tiếp hoặc thanh toán trực tuyến khi đăng ký.</p>
            </div>
        </div>
    </section>
    <!-- footer -->
    <?php include Import::view_layout_path("footer/user-footer.php") ?>
</body>

</html>