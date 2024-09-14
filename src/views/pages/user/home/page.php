<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Trang chủ</title>
</head>

<body class="transition-all">
    <!-- header -->
    <?php require Import::view_layout_path("header/user-header.php") ?>
    <!-- main content -->


    <section id="default-carousel" class="relative w-full px-4 md:px-20 pt-4 md:pt-5 md:pb-12" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-[28rem]">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="<?php echo Import::view_assets_path("anh-truong-slide-5.png");?>" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover h-full" alt="">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="<?php echo Import::view_assets_path("anh-truong-slide-4.jpg");?>" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover h-full" alt="">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="<?php echo Import::view_assets_path("anh-truong-slide-3.png");?>" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover h-full" alt="">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="<?php echo Import::view_assets_path("anh-truong-slide-2.jpg");?>" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover h-full" alt="">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="<?php echo Import::view_assets_path("anh-truong-slide-1.jpg");?>" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover h-full" alt="">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-1 md:start-10 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-1 md:end-10 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </section>

    <section class="text-gray-700 body-font md:px-10">
        <div class="container mx-auto flex px-5 py-16 md:flex-row flex-col items-center">
            <div data-aos="fade-right" class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Khát vọng vươn tới
                    <br class="hidden lg:inline-block">đỉnh cao tri thức
                </h1>
                <p class="mb-8 leading-relaxed">Trường THPT Chuyên Lê Hồng Phong, TP.HCM, là một trong những ngôi trường danh tiếng nhất Việt Nam, được thành lập từ năm 1927. Trường nổi bật với chương trình đào tạo chuyên sâu, đội ngũ giáo viên xuất sắc, và nhiều học sinh đạt thành tích cao trong các kỳ thi quốc gia và quốc tế. Đây là môi trường lý tưởng để học sinh phát triển toàn diện, từ học tập đến các hoạt động ngoại khóa, hướng tới thành công trong tương lai.</p>
                <div class="flex justify-center">
                    <a href="<?php echo Import::view_page_path("user/admissions/registration-form.php");?>" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Lập hồ sơ thi tuyển</a>
                </div>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                <img class="object-cover object-center rounded" alt="anh-truong" src="https://nld.mediacdn.vn/2017/img-7854-1504517216903.jpg" data-aos="fade-up">
            </div>
        </div>
    </section>
    <section class="text-gray-700 body-font border-t border-gray-200 md:px-10">
        <div class="container px-5 py-16 mx-auto flex flex-wrap">
            <div data-aos="fade-right" class="lg:w-1/2 w-full mb-10 lg:mb-0 rounded-lg overflow-hidden">
                <img alt="feature" class="object-cover object-center h-full w-full" src="<?php echo Import::view_assets_path("lehongphong.jpg"); ?>">
            </div>
            <div class="flex flex-col flex-wrap lg:py-6 -mb-10 lg:w-1/2 lg:pl-12 lg:text-left text-center">
                <div data-aos="fade-up" class="flex flex-col mb-10 lg:items-start items-center">
                    <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Lịch sử lâu đời và danh tiếng</h2>
                        <p class="leading-relaxed text-base">Trường THPT Chuyên Lê Hồng Phong, với hơn 90 năm phát triển, là một trong những ngôi trường có truyền thống học thuật hàng đầu tại Việt Nam.</p>
                    </div>
                </div>
                <div data-aos="fade-up" class="flex flex-col mb-10 lg:items-start items-center">
                    <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                            <circle cx="6" cy="6" r="3"></circle>
                            <circle cx="6" cy="18" r="3"></circle>
                            <path d="M20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12"></path>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Chương trình đào tạo chuyên sâu</h2>
                        <p class="leading-relaxed text-base"> Trường cung cấp chương trình học chuyên biệt cho học sinh giỏi, với các lớp chuyên về Toán, Lý, Hóa, Sinh, Văn, Anh, và nhiều môn khác, giúp học sinh phát triển tư duy và kiến thức chuyên sâu.</p>
                    </div>
                </div>
                <div data-aos="fade-up" class="flex flex-col mb-10 lg:items-start items-center">
                    <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Thành tích xuất sắc</h2>
                        <p class="leading-relaxed text-base">Học sinh của trường thường đạt thành tích cao trong các kỳ thi học sinh giỏi quốc gia và quốc tế, khẳng định vị thế của trường trong hệ thống giáo dục Việt Nam.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-gray-700 body-font border-t border-gray-200">
        <div data-aos="fade-up" class="container px-5 py-16 mx-auto">
            <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="inline-block w-8 h-8 text-gray-400 mb-8" viewBox="0 0 975.036 975.036">
                    <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                </svg>
                <p class="leading-relaxed text-lg">Tôi đã học được rằng sự trưởng thành không phải là đạt được những điều mình muốn, mà là học cách đối mặt với những thử thách, vượt qua khó khăn và tiếp tục tiến bước. Thật sự, thành công không phải là kết quả của những chiến thắng đơn lẻ, mà là sự kiên trì, lòng dũng cảm và khả năng đứng dậy mỗi khi thất bại. Chính những nỗ lực không ngừng nghỉ và tinh thần không bỏ cuộc sẽ đưa bạn đến gần hơn với mục tiêu của mình. Hãy luôn tin vào bản thân, và tiếp tục hành trình của mình với niềm tin và sự quyết tâm.</p>
                <span class="inline-block h-1 w-10 rounded bg-indigo-500 mt-8 mb-6"></span>
                <h2 class="text-gray-900 font-medium title-font tracking-wider text-sm">Nelson Mandela</h2>
            </div>
        </div>
    </section>
    <section class="text-gray-700 body-font relative">
        <div class="inset-0 bg-gray-300 h-96">
            <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3738.7275179704734!2d106.18008567911004!3d20.43529133225909!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135e7391bf25163%3A0x4c65ff0561a8b328!2sL%C3%AA%20H%E1%BB%93ng%20Phong%20High%20School%20For%20The%20Gifted!5e0!3m2!1sen!2sus!4v1726084253317!5m2!1sen!2sus"></iframe>
        </div>
    </section>
    <!-- footer -->
    <?php include Import::view_layout_path("footer/user-footer.php") ?>
</body>

</html>