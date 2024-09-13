<style>
    .active-link {
        position: relative;
    }

    .active-link::before {
        content: "";
        position: absolute;
        bottom: -1rem;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #374151;
    }

    .inactive-link {
        position: relative;
    }

    .inactive-link:hover::before {
        content: "";
        position: absolute;
        bottom: -1rem;
        left: 0;
        height: 3px;
        width: 100%;
        background-color: #374151;
        animation: link_animation 0.2s linear;
    }

    @keyframes link_animation {
        0% {
            width: 0%;
        }

        100% {
            width: 100%;
        }
    }
</style>
<header>
    <div class="w-full mx-auto container py-4">
        <div class="container w-full flex justify-between items-center px-5 md:px-20">
            <a href="/" class="flex items-center">
                <img src="<?php echo Env::get("system")["logo"]; ?>" alt="banner" class="h-10 md:h-16 w-fit object-cover">
                <h1 class="flex flex-col text-gray-800">
                    <span>Trường THPT Chuyên </span>
                    <span class="font-semibold"><?php echo Env::get("system")["name"]; ?></span>
                </h1>
            </a>
            <button class="md:hidden" id="menu-btn">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
    <!-- nav desktop  -->
    <nav class="bg-[#fed014] hidden md:block">
        <ul class="uppercase container mx-auto flex justify-start items-center gap-4 py-4 px-20 font-semibold text-gray-700">
            <li class="<?php echo isActiveLink("user/home/page.php") ? "active-link" : "inactive-link"; ?>">
                <a href="<?php echo Import::view_page_path("user/home/page.php"); ?>">trang chủ</a>
            </li>
            <li class="<?php echo isActiveLink("user/admissions/page.php") ? "active-link" : "inactive-link"; ?>">
                <a href="<?php echo Import::view_page_path("user/admissions/page.php"); ?>">tuyển sinh</a>
            </li>


            <button id="dropdownHoverButtonDesktop" data-dropdown-toggle="dropdownHoverDesktop" data-dropdown-trigger="hover" class="uppercase inactive-link flex items-center justify-center space-x-2" type="button">
                <span>Tra cứu</span>
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <!-- tra cứu menu  -->
            <div id="dropdownHoverDesktop" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class=" text-sm text-gray-700" aria-labelledby="dropdownHoverButtonDesktop">
                    <li class="hover:bg-slate-200 px-4 py-3 rounded-t-lg">
                        <a href="<?php echo Import::view_page_path("user/lookup/exam-schedule/page.php"); ?>">lịch thi</a>
                    </li>
                    <li class="hover:bg-slate-200 px-4 py-3 rounded-b-lg">
                        <a href="<?php echo Import::view_page_path("user/lookup/admission-result/page.php"); ?>">kết quả thi tuyển</a>
                    </li>
                </ul>
            </div>

            <?php if (AuthMiddleware::isAuth()) : ?>
                <li class="<?php echo (isActiveLink("user/profile/page.php") ? "active-link" : "inactive-link") ?>">
                    <a href="<?php echo Import::view_page_path("user/profile/page.php") ?>">tài khoản</a>
                </li>
                <li class="inactive-link">
                    <button class="uppercase" id="logout-btn">đăng xuất</button>
                </li>
            <?php else: ?>
                <li class="inactive-link">
                    <a href="<?php echo Import::view_page_path("auth/login.php"); ?>">đăng nhập</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <!-- nav mobile  -->
    <nav class="bg-[#fed014] hidden" id="nav-mobile">
        <ul class="uppercase container mx-auto p-4 space-y-2 font-semibold text-gray-700">
            <li class="<?php echo isActiveLink("user/home/page.php") ? "text-white" : ""; ?>">
                <a href="<?php echo Import::view_page_path("user/home/page.php"); ?>">trang chủ</a>
            </li>
            <li class="<?php echo isActiveLink("user/admissions/page.php") ? "text-white" : ""; ?>">
                <a href="<?php echo Import::view_page_path("user/admissions/page.php"); ?>">tuyển sinh</a>
            </li>


            <button id="dropdownDefaultButtonMobile" data-dropdown-toggle="dropdownMobile" class="uppercase inactive-link flex items-center justify-center space-x-2" type="button">Tra cứu<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="dropdownMobile" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownDefaultButtonMobile">
                    <li class="hover:bg-slate-200 px-4 py-3 rounded-t-lg">
                        <a href="<?php echo Import::view_page_path("user/lookup/exam-schedule/page.php"); ?>">lịch thi</a>
                    </li>
                    <li class="hover:bg-slate-200 px-4 py-3 rounded-b-lg">
                        <a href="<?php echo Import::view_page_path("user/lookup/admission-result/page.php"); ?>">kết quả thi tuyển</a>
                    </li>
                </ul>
            </div>

            <?php if (AuthMiddleware::isAuth()) : ?>
                <li class="<?php echo (isActiveLink("user/profile/page.php") ? "active-link" : "inactive-link") ?>">
                    <a href="<?php echo Import::view_page_path("user/profile/page.php") ?>">tài khoản</a>
                </li>
                <li class="inactive-link">
                    <button class="uppercase" id="logout-btn">đăng xuất</button>
                </li>
            <?php else: ?>
                <li class="inactive-link">
                    <a href="<?php echo Import::view_page_path("auth/login.php"); ?>">đăng nhập</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<!-- header fixed  -->
<header class="hidden fixed w-full top-0 z-40" id="header-fixed">
    <nav class="bg-[#fed014] px-52 py-1 flex min-w-screen mx-auto">
        <a href="/" class="flex items-center w-full">
            <img src="<?php echo Env::get("system")["logo"]; ?>" alt="banner" class="h-10 md:h-16 w-fit object-cover">
            <h1 class="flex flex-col text-gray-800">
                <span>Trường THPT Chuyên </span>
                <span class="font-semibold"><?php echo Env::get("system")["name"]; ?></span>
            </h1>
        </a>
        <ul class="uppercase container mx-auto flex justify-start items-center gap-4 py-4 font-semibold text-gray-700">
            <li class="<?php echo isActiveLink("user/home/page.php") ? "active-link" : "inactive-link"; ?>">
                <a href="<?php echo Import::view_page_path("user/home/page.php"); ?>">trang chủ</a>
            </li>
            <li class="<?php echo isActiveLink("user/admissions/page.php") ? "active-link" : "inactive-link"; ?>">
                <a href="<?php echo Import::view_page_path("user/admissions/page.php"); ?>">tuyển sinh</a>
            </li>

            <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="uppercase inactive-link flex items-center justify-center space-x-2" type="button">
                <span>Tra cứu</span>
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <!-- tra cứu menu  -->
            <div id="dropdownHover" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class=" text-sm text-gray-700" aria-labelledby="dropdownHoverButton">
                    <li class="hover:bg-slate-200 px-4 py-3 rounded-t-lg">
                        <a href="<?php echo Import::view_page_path("user/lookup/exam-schedule/page.php"); ?>">lịch thi</a>
                    </li>
                    <li class="hover:bg-slate-200 px-4 py-3 rounded-b-lg">
                        <a href="<?php echo Import::view_page_path("user/lookup/admission-result/page.php"); ?>">kết quả thi tuyển</a>
                    </li>
                </ul>
            </div>
            <?php if (AuthMiddleware::isAuth()) : ?>
                <li class="<?php echo (isActiveLink("user/profile/page.php") ? "active-link" : "inactive-link") ?>">
                    <a href="<?php echo Import::view_page_path("user/profile/page.php") ?>">tài khoản</a>
                </li>
                <li class="inactive-link">
                    <button class="uppercase" id="logout-btn">đăng xuất</button>
                </li>
            <?php else: ?>
                <li class="inactive-link">
                    <a href="<?php echo Import::view_page_path("auth/login.php"); ?>">đăng nhập</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<script>
    document.addEventListener('wheel', (ev) => {
        if (window.screen.width > 768) {
            if (ev.deltaY < 0) {
                document.getElementById('header-fixed').classList.add('hidden');
            } else {
                document.getElementById('header-fixed').classList.remove('hidden');
            }
        }
    })
    $(() => {
        $("#menu-btn").click(() => {
            $("#nav-mobile").slideToggle(500);
        })
        $("#logout-btn").click(() => {
            const url = "<?php echo Import::route_path("auth.route.php"); ?>"
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    method: "logout"
                },
                success: function(response) {
                    window.location.href = "<?php echo Env::get("server"); ?>";
                }
            })
        })
    })
</script>