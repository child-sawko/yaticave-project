<?php
$is_auth = rand(0, 1);

$user_name = 'child-sawko'; // укажите здесь ваше имя
$massiv_category = [
    [
        'eng' => 'boards',
        'rus' => 'Доски и лыжи',
    ],
    [
        'eng' => 'attachment',
        'rus' => 'Крепления',
    ],
    [
        'eng' => 'boots',
        'rus' => 'Ботинки',
    ],
    [
        'eng' => 'clothing',
        'rus' => 'Одежда',
    ],
    [
        'eng' => 'tools',
        'rus' => 'Инструменты',
    ],
    [
        'eng' => 'other',
        'rus' => 'Разное',
    ],
];
$information = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '10990',
        'url-img' => 'img/lot-1.jpg'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '159999',
        'url-img' => 'img/lot-2.jpg'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => '8000',
        'url-img' => 'img/lot-3.jpg'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => '10999',
        'url-img' => 'img/lot-4.jpg'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => '7500',
        'url-img' => 'img/lot-5.jpg'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => '5400',
        'url-img' => 'img/lot-6.jpg'
    ],
];
function format ($number)
{
    $number = ceil($number);
    if($number<1000)
    {
        $result = $number;
    }
    else
    {
        $result = number_format($number,0,","," ");
    }
    return $result.'<b class="rub">p</b>';
}

function timer()
{
    $now = new DateTime('now');
    $night = new DateTime('24:00');
    $interval = $now->diff($night);
    return $interval->format('%h:%i');
}
function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';
    if (!file_exists($name)) {
        return $result;
    }
    ob_start();
    extract($data);
    require($name);
    $result = ob_get_clean();
    return $result;
}
?>
