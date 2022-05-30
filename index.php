<?php
require_once('functions.php');
require_once('data.php');
$connection = new mysqli('127.0.0.1', 'root','', 'bd_yeticave');
$page_content = include_template('index.php', [
    'massiv_category' => $massiv_category,
    'information' => $information,
]);
$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'massiv_category' => $massiv_category,
    'massiv_users' => $massiv_users,
    'title' => 'Главная страница',
    'user_name' => $user,

]);
print($layout_content);
?>

