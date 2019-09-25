<?php
function connect(
    $host='localhost:3306',
    $user='root',
    $password='11111111',
    $dbname='tour_travel_db'
){
    $cs="mysql:host=$host;dbname=$dbname;charset=utf8";
    $option=[
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,//генерация исключений в этом же месте
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'
    ];
    try{
        $pdo=new PDO($cs, $user, $password, $option);
        return $pdo;
    }
    catch (PDOException $exception){
        echo $exception->getMessage();
        return false;
    }
}

//$pdo=connect();
//$list=$pdo->query('select * from countries');
//while($row=$list->fetch()){
//    echo 'id='.$row['id'].', country='.$row['country']."<br>";
//}
