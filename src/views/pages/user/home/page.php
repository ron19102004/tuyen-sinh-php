<?php require $_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php";
Import::middlewares(files_name: ["auth.middleware.php"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require Import::view_layout_path("head.php"); ?>
    <title>Trang chủ</title>
</head>

<body>
    <!-- header -->
    <?php require Import::view_layout_path("header/user-header.php") ?>
    <!-- main content -->
    user id : <?php echo Session::get("user_id")?>
    <!-- footer -->
    <?php include Import::view_layout_path("footer/user-footer.php") ?>
</body>

</html>