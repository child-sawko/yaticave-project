<?php
require_once ('functions.php');
require_once ('data.php');

$ID = $_GET['pages'];

$connection = new mysqli('127.0.0.1','root','','bd_yeticave');
$query = "Select * from category order by id_category";
$category_result = $connection->query($query);
$category = $category_result->fetch_all(MYSQLI_ASSOC);

$query1 = "SELECT lot_name,id_lot, category.category_name, description, image_url, start_price FROM lot INNER JOIN category on lot.id_category = category.id_category where id_lot=$ID";
$lot_result = $connection->query($query1);
$lot = $lot_result->fetch_array(1);


$query3 = "Select name,sum date
    from bid b
        inner join users u on b.id_user = u.id_user
    where b.id_lot=$ID";
$bid_result = $connection->query($query3);
$bid = $bid_result->fetch_all(1);

$page_content = include_template('lot.php',[
    'massiv_category' => $massiv_category,
    'information' => $information,
    'ID' => $ID,
    'category'=>$category,
    'lot'=>$lot,
    'bid'=>$bid
] );

$layout_content = include_template('layout.php', [
    'main' => $page_content,
    'massiv_category'=>$massiv_category,
    'title' => $lot["lot_name"],
    'is_auth'=>$is_auth,
    'user_name' => $user_name
]);

if((string)$ID == $lot['id_lot'])
{
    print $layout_content;
}
else
{
    header("Location: 404.php");
}


?>