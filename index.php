<?php
include_once 'pages/classes.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<header>
    <?php include_once 'pages/menu.php'?>
</header>
<div class="container">
    <div class="row">
        <section class="col-md-12">
            <?php if(isset($_GET['page'])){
                $page = $_GET['page'];
                if($page == 1){
                    include_once 'pages/catalog.php';
                }
                else if($page == 2){
                    include_once 'pages/card.php';
                }
                else if($page == 3){
                    include_once 'pages/registration.php';
                }
                else if($page == 4){
                    include_once 'pages/admin.php';
                }
                else if($page == 5){
                    include_once 'pages/reports.php';
                }
            }
            else{
                include_once 'pages/catalog.php';
            }
            ?>
        </section>
    </div>
    <div class="footer">Ajjano, company Step &copy; 2019</div>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>