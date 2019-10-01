<?php
    include_once 'classes.php';
    $category_id= $_POST['category_id'];
    $pdo=Tools::connect();
    $ps=$pdo->prepare('select * from items where category_id=?');
    $ps->execute([$category_id]);
    echo json_encode($ps->fetchAll());
