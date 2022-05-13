<?php
require_once('functions.php');

$page_content = include_template('index.php', ['massiv_category' => $massiv_category, 'information' => $information]);
$layout_content = include_template('layout.php', [
    'main' => $page_content,
    'category' => $category,
    'title' => 'Главная страница',
    'massiv_category' => $massiv_category,
    'is_auth' => $is_auth,
    'user_name' => $user_name

]);

print($layout_content);
