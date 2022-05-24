<?php
$link = mysqli_connect('127.0.0.1','root','','bd_yeticave');
mysqli_set_charset($link, 'utf8_general_ci');

$sql = 'SELECT * FROM category';
$result = mysqli_query($link, $sql);
$massiv_category = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql2 = 'SELECT lot_name, category_name, description, image_url, start_price FROM lot INNER JOIN category ON lot.id_category = category.id_category';
$result2 = mysqli_query($link, $sql2);
$information = mysqli_fetch_all($result2,MYSQLI_ASSOC);
?>
