<?php
require_once ('functions.php');
require_once ('data.php');

$date_main = ['massiv_category'=>$massiv_category];

$page_content = include_template("add.php", $date_main);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'massiv_category'=>$massiv_category,
    'massiv_users' =>$massiv_users,
    'title' => 'Добавление лота',
    'user_name' => $user
]);
print($layout_content);
?>
