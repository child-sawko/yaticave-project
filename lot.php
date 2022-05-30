<?php
require_once ('functions.php');
require_once ('data.php');

$ID = intval($_GET['pages']);

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

if(!empty($lot['id_lot']))
{
    $date_main = ['category'=>$category, 'lot'=>$lot,'bid'=>$bid];

    $page_content = include_template("lot.php", $date_main);

    $layout_content = include_template('layout.php', [
        'page_content' => $page_content,
        'massiv_category'=>$massiv_category,
        'massiv_users' =>$massiv_users,
        'title' => $lot["lot_name"],
        'user_name' => $user
    ]);
    print $layout_content;

}
else
{
    $page_content = include_template("404.php",['category' => $category]);

    $layout_content = include_template('layout.php', [
        'page_content' => $page_content,
        'massiv_category'=>$massiv_category,
        'massiv_users' =>$massiv_users,
        'title' => $lot["lot_name"],
        'user_name' => $user
    ]);
    print $layout_content;
}
?>
