<?php
include_once 'classes.php';
$pdo=Tools::connect();

$role="
    create table roles(
    id int not null auto_increment PRIMARY KEY,
    role VARCHAR(25) not null UNIQUE 
    ) DEFAULT charset = 'utf8'
";

$customer="
    create table customers(
    id int not null auto_increment PRIMARY KEY,
    login VARCHAR(25) not null UNIQUE,
    password VARCHAR (128) not null,
    role_id int,
    FOREIGN  KEY (role_id) REFERENCES roles(id) on update CASCADE,
    discount int,
    image_path VARCHAR (255) 
    ) DEFAULT charset = 'utf8'
";

$category="
    create table categories(
    id int not null auto_increment PRIMARY KEY,
    category VARCHAR(64) not null UNIQUE
    ) DEFAULT charset = 'utf8'
";

$item="
    create table items(
    id int not null auto_increment PRIMARY KEY,
    item_name VARCHAR(120) not null,
    category_id int,
    FOREIGN KEY (category_id) REFERENCES categories(id) on UPDATE CASCADE,
    price_in VARCHAR(25) not NULL,
    price_sale VARCHAR(25) not null,
    info VARCHAR(255) not NULL,
    image_path VARCHAR(255) not NULL
    ) DEFAULT charset = 'utf8'
";

$image="
    create table images(
    id int not null auto_increment PRIMARY KEY,
    item_id int,
    FOREIGN key (item_id) REFERENCES items(id) on update CASCADE ,
    image_path VARCHAR (255) not NULL 
    ) DEFAULT charset = 'utf8'
";

$sale="
    create table sales(
    id int not null auto_increment PRIMARY KEY,
    customer_id int,
    FOREIGN  KEY (customer_id) REFERENCES customers(id) on UPDATE CASCADE ,
    item_id int,
    FOREIGN  KEY (item_id) REFERENCES items(id) on UPDATE  CASCADE ,
    created TIMESTAMP ,
    quantity int not null
    ) DEFAULT charset = 'utf8'
";


$pdo->exec($role);
$pdo->exec($customer);
$pdo->exec($category);
$pdo->exec($item);
$pdo->exec($image);
$pdo->exec($sale);
