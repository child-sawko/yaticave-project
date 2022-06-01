<?php
require_once('functions.php');
require_once ('data.php');

$error = [];
$message = [];
$flag = 0;
$pattern = '/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i';
$form = '';

$connection = new mysqli('127.0.0.1', 'root', '', 'bd_yeticave');

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $email = clear_data($_POST['email']);
    $password = clear_data($_POST['password']);

    if(empty($email))
    {
        $error['email'] = 'form__item--invalid';
        $message['email'] = '<span class="form__error">Введите e-mail</span>';
        $flag = 1;
    }
    else
    {
        if(!preg_match($pattern,$email))
        {
            $error['email'] = 'form__item--invalid';
            $message['email'] = '<span class="form__error">Некорректно введен адрес электронной почты</span>';
            $flag = 1;
        }
    }
    if(empty($password))
    {
        $error['password'] = 'form__item--invalid';
        $message['password'] = '<span class="form__error">Введите пароль</span>';
        $flag = 1;
    }
    if(!empty($error))
    {
        $form = 'form--invalid';
        $message['form'] = '<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>';
        $flag = 1;
    }
    if(!empty($email)&&!empty($password))
    {
        $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";

        $query_result = $connection->query($query);

        $result = $query_result-> fetch_array();

        if(empty($result))
        {
            $form = 'form--invalid';
            $message['form'] = '<span class="form__error form__error--bottom">Вы ввели неправильную почту или пароль</span>';
            $flag = 1;

            $date_main = ['massiv_category' => $massiv_category, 'error' => $error, 'message' => $message, 'form' => $form,'user' => $user];

            $page_content = include_template('login.php', $date_main);
            $layout_content = include_template('layout.php', [
                'page_content' => $page_content,
                'massiv_category' => $massiv_category,
                'massiv_users' =>$massiv_users,
                'title' => 'Вход',
                'user' => $user
            ]);

            print($layout_content);
            exit();
        }
        else
        {
            setcookie('user', $result['name'], time() + 3600, "/");

            $connection->close();

            header('Location: index.php');
        }
    }
    else
    {
        $date_main = ['massiv_category' => $massiv_category, 'error' => $error, 'message' => $message, 'form' => $form,'user' => $user];

        $page_content = include_template('login.php', $date_main);
        $layout_content = include_template('layout.php', [
            'page_content' => $page_content,
            'massiv_category' => $massiv_category,
            'massiv_users' =>$massiv_users,
            'title' => 'Вход',
            'user' => $user
        ]);

        print($layout_content);
    }
}
else
{
    $date_main = ['massiv_category' => $massiv_category, 'error' => $error, 'message' => $message, 'form' => $form,'user' => $user];

    $page_content = include_template('login.php', $date_main);
    $layout_content = include_template('layout.php', [
        'page_content' => $page_content,
        'massiv_category' => $massiv_category,
        'massiv_users' =>$massiv_users,
        'title' => 'Вход',
        'user' => $user
    ]);

    print($layout_content);
}
?>
