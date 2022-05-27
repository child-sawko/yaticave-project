<?php
require_once('functions.php');
require_once('data.php');
$connection = new mysqli('127.0.0.1', 'root','', 'bd_yeticave');
$page_content = include_template('index.php', [
    'massiv_category' => $massiv_category,
    'information' => $information,
]);
$layout_content = include_template('layout.php', [
    'main' => $page_content,
    'massiv_category' => $massiv_category,
    'title' => 'Главная страница',
    'massiv_category' => $massiv_category,
    'is_auth' => $is_auth,
    'user_name' => $user_name,

]);
print($layout_content);
?>

