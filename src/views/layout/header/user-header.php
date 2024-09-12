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
            <?php
            AuthMiddleware::isAuthenticated(function () {
                //account
                echo '<li class="' . (isActiveLink("user/profile/page.php") ? "active-link" : "inactive-link") . '">';
                echo '   <a href="' . Import::view_page_path("user/profile/page.php") . '">tài khoản</a>';
                echo '</li>';
                //logout
                echo '<li class="inactive-link">';
                echo '<button class="uppercase" id="logout-btn">đăng xuất</button>';
                echo '</li>';
            }, function () {
                echo '<li class="inactive-link">';
                echo '   <a href="' . Import::view_page_path("auth/login.php") . '">đăng nhập</a>';
                echo '</li>';
            });
            ?>
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
            <?php
            AuthMiddleware::isAuthenticated(function () {
                //account
                echo '<li class="' . (isActiveLink("user/profile/page.php") ? "active-link" : "inactive-link") . '">';
                echo '   <a href="' . Import::view_page_path("user/profile/page.php") . '">tài khoản</a>';
                echo '</li>';
                //logout
                echo '<li class="inactive-link">';
                echo '<button class="uppercase" id="logout-btn">đăng xuất</button>';
                echo '</li>';
            }, function () {
                echo '<li class="inactive-link">';
                echo '   <a href="' . Import::view_page_path("auth/login.php") . '">đăng nhập</a>';
                echo '</li>';
            });
            ?>
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
            <?php
            AuthMiddleware::isAuthenticated(function () {
                //account
                echo '<li class="' . (isActiveLink("user/profile/page.php") ? "active-link" : "inactive-link") . '">';
                echo '   <a href="' . Import::view_page_path("user/profile/page.php") . '">tài khoản</a>';
                echo '</li>';
                //logout
                echo '<li class="inactive-link">';
                echo '<button class="uppercase" id="logout-btn">đăng xuất</button>';
                echo '</li>';
            }, function () {
                echo '<li class="inactive-link">';
                echo '   <a href="' . Import::view_page_path("auth/login.php") . '">đăng nhập</a>';
                echo '</li>';
            });
            ?>
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