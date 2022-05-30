<?php
require_once ('functions.php');
require_once ('data.php');

$connection = new mysqli('127.0.0.1', 'root', '', 'bd_yeticave');

$pattern = '/^[ 0-9]+$/';

$error = [];
$message = [];
$flag = 0;
$form = '';
$date = date('Y-m-d H:i:s');

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $lot_name = clear_data($_POST['lot_name']);
    $category_name = clear_data($_POST['category_name']);
    $category_name_eng = clear_data($_POST['category_name_eng']);
    $description = clear_data($_POST['description']);
    $image_url = clear_data('img/'.$_FILES['image_url']['name']);
    $start_price = clear_data($_POST['start_price']);
    $bid_step = clear_data($_POST['bid_step']);
    $date_finish = clear_data($_POST['date_finish']);

    if(empty($lot_name))
    {
        $error['lot_name'] = 'form__item--invalid';
        $message['lot_name'] = '<span class="form__error">Введите наименование лота</span>';
        $flag = 1;
    }
    if($category_name=="Выберите категорию")
    {
        $error['category_name'] = 'form__item--invalid';
        $message['category_name'] = '<span class="form__error">Выберите категорию</span>';
        $flag = 1;
    }
    if(empty($description))
    {
        $error['description'] = 'form__item--invalid';
        $message['description'] = '<span class="form__error">Напишите описание лота</span>';
        $flag = 1;
    }
    if(empty($image_url))
    {
        $error['image_url'] = 'form__item--invalid';
        $message['image_url'] = '<span class="form__error">Добавьте изображение к лоту</span>';
        $flag = 1;
    }
    else
    {
        move_uploaded_file($_FILES['image_url']['tmp_name'], 'img/'.$_FILES['image_url']['name']);
    }
    if(empty($start_price))
    {
        $error['start_price'] = 'form__item--invalid';
        $message['start_price']= '<span class="form__error">Введите начальную цену</span>';
        $flag = 1;
    }
    else
    {
        if(!preg_match($pattern, $start_price))
        {
            $error['start_price'] = 'form__item--invalid';
            $message['start_price'] = '<span class="form__error">Используйте только цифры</span>';
            $flag = 1;
        }
    }
    if(empty($bid_step))
    {
        $error['bid_step'] = 'form__item--invalid';
        $message['bid_step']= '<span class="form__error">Введите шаг ставки</span>';
        $flag = 1;
    }
    else
    {
        if(!preg_match($pattern, $bid_step)) {
            $error['bid_step'] = 'form__item--invalid';
            $message['bid_step'] = '<span class="form__error">Используйте только цифры</span>';
            $flag = 1;
        }
    }
    if(empty($date_finish))
    {
        $error['date_finish'] = 'form__item--invalid';
        $message['date_finish'] = '<span class="form__error">Введите дату завершения торгов</span>';
        $flag = 1;
    }
    else
    {
        if($date_finish<= $date)
        {
            $error['date_finish'] = 'form__item--invalid';
            $message['date_finish'] = '<span class="form__error">Введите актуальную дату завершения торгов</span>';
            $flag = 1;
        }
    }
    if(!empty($error))
    {
        $form = 'form--invalid';
        $message['form'] = '<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>';
        $flag = 1;
    }

    if(!empty($lot_name)&&!empty($category_name)&&!empty($description)&&!empty($image_url)&&!empty($start_price)&&!empty($bid_step)&&!empty($date_finish))
    {
        $query1 = "select id_category from category where name = '$category_name'";

        $query = "insert into lot (id_winner,id_user,id_category,date_finish,lot_name,description,image_url,start_price,date_finish,bid_step) value (NULL,1,($query1),now(),'$lot_name','$description','$image_url',$start_price,'$date_finish',$bid_step)";
        $category_result = $connection->query($query);
    }

    /*$query2 = "select id_lot from lot where lot_name = $lot_name";
    $query2_result = mysql_query($query2);
    $row = mysql_fetch_array($query2_result);

    if(!empty($row))
    {
        $new_url = 'yeticave/lot.php?pages='.$row.'';
        header('Location:'.$new_url);
    }*/

    $date_main = ['massiv_category'=>$massiv_category,'error'=>$error,'message'=>$message,'form'=>$form];

    $page_content = include_template("add.php", $date_main);

    $layout_content = include_template('layout.php', [
        'page_content' => $page_content,
        'massiv_category'=>$massiv_category,
        'massiv_users' =>$massiv_users,
        'title' => 'Добавление лота',
        'user_name' => $user
    ]);
    print($layout_content);
}
else
{
    $data_main = ['massiv_category'=>$massiv_category,'err'=>$error,'message'=>$message,'form'=>$form];

    $page_content = include_template("add.php", $data_main);

    $layout_content = include_template('layout.php', [
        'page_content' => $page_content,
        'massiv_category'=>$massiv_category,
        'massiv_users' =>$massiv_users,
        'title' => 'Добавление лота',
        'user_name' => $user
    ]);

    print($layout_content);
}
?>
