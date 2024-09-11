<?php require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/import.util.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(Import::view_layout_path("head.php")); ?>
    <title>Tuyển sinh</title>
</head>

<body>
    <a href="<?php echo Import::view_page_path("auth/login.php"); ?>">login</a>
ư
    <!-- footer -->
    <?php include Import::view_layout_path("footer.php") ?>
</body>

</html>