<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S. CAR WASH</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/LOGO.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<?php
    include ("models/conexion.php");
	$pg = isset($_GET["pg"]) ? $_GET["pg"]:NULL;
?>
    <nav>
        <?php include ("views/vmenui.php"); ?>
    </nav>

    <section class="pri">
    <?php
        if(!$pg)
            require_once("index.php");
        if(!$pg=="1001")
            require_once("views/vinfo.php");
        if($pg=="1002")
            require_once("views/vlogin.php");
    ?>
    </section>

    <footer>
        <?php include("views/footer.php"); ?>
    </footer>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>