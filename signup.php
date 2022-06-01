<?php
require_once('functions.php');
require_once ('data.php');

$error = [];
$message = [];
$flag = 0;
$form = '';
$pattern = '/\A[А-Яа-яЁё]/';
$pattern1 = '/^[ 0-9]+$/';
$pattern2 = '/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i';

$connection = new mysqli('127.0.0.1', 'root', '', 'bd_yeticave');


if($_SERVER['REQUEST_METHOD']=='POST')
{
    $name = clear_data($_POST['name']);
    $contacts = clear_data($_POST['contacts']);
    $email = clear_data($_POST['email']);
    $password = clear_data($_POST['password']);
    $avatar = clear_data($_FILES['avatar']['name']);

    if(empty($name))
    {
        $error['name'] = 'form__item--invalid';
        $message['name'] = '<span class="form__error">Введите Имя пользователя.</span>';
        $flag = 1;
    }
    else
    {
        if(!preg_match($pattern,$name))
        {
            $error['name'] = 'form__item--invalid';
            $message['name'] = '<span class="form__error">Имя пользователя может содержать только кириллицу.</span>';
            $flag = 1;
        }
    }
    if(empty($contacts))
    {
        $error['contacts'] = 'form__item--invalid';
        $message['contacts'] = '<span class="form__error">Введите номер Вашего телефона.</span>';
        $flag = 1;
    }
    else
    {
        if(!preg_match($pattern1,$contacts))
        {
            $error['contacts'] = 'form__item--invalid';
            $message['contacts'] = '<span class="form__error">Номер телефона может содержать только цифры.</span>';
            $flag = 1;
        }
    }
    if(empty($email))
    {
        $error['email'] = 'form__item--invalid';
        $message['email'] = '<span class="form__error">Введите e-mail</span>';
        $flag = 1;
    }
    else
    {
        if(!preg_match($pattern2,$email))
        {
            $error['email'] = 'form__item--invalid';
            $message['email'] = '<span class="form__error">Некорректно введен адрес электронной почты.</span>';
            $flag = 1;
        }
    }
    if(empty($password))
    {
        $error['password'] = 'form__item--invalid';
        $message['password'] = '<span class="form__error">Введите пароль.</span>';
        $flag = 1;
    }
    if(empty($avatar))
    {
        $error['avatar'] = 'form__item--invalid';
        $message['avatar'] = '<span class="form__error">Добавьте фото профиля.</span>';
        $flag = 1;
    }
    else
    {
        if(!empty($form))
        {
            $error['avatar'] = 'form__item--invalid';
            $message['avatar'] = '<span class="form__error">Ошибка загрузки.</span>';
            $flag = 1;
        }
        else
        {
            move_uploaded_file($_FILES['avatar']['name'], 'img/'.$_FILES['avatar']['name']);
        }
    }
    if(!empty($error))
    {
        $form = 'form--invalid';
        $message['form'] = '<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>';
        $flag = 1;
    }
    if(!empty($name)&&!empty($contacts)&&!empty($email)&&!empty($password)&&!empty($avatar))
    {
        $result = $connection->query("SELECT email, contacts FROM users WHERE email = '$email' OR contacts = '$contacts'");

        if (mysqli_num_rows($result) > 0)
        {
            $form = 'form--invalid';
            $message['form'] = '<span class="form__error form__error--bottom">Профиль с такими данными уже существует.</span>';
            $flag = 1;

            $date_main = ['massiv_category' => $massiv_category,'error' => $error, 'message' => $message, 'form' => $form,'user' => $user];

            $page_content = include_template('signup.php', $date_main);
            $layout_content = include_template('layout.php', [
                'page_content' => $page_content,
                'massiv_category' => $massiv_category,
                'massiv_users' =>$massiv_users,
                'title' => 'Регистрация',
                'user' => $user
            ]);

            print($layout_content);
        }
        else
        {
            $query = "INSERT INTO users (id_user, date_registration, email, name, password, avatar, contacts) VALUES (NULL,now(),'$email','$name','$password','$avatar','$contacts')";

            $query_result = $connection->query($query);

            $connection->close();

            header('Location: login.php');
        }
    }
    $date_main = ['massiv_category' => $massiv_category,'error' => $error, 'message' => $message, 'form' => $form,'user' => $user];

    $page_content = include_template('signup.php', $date_main);
    $layout_content = include_template('layout.php', [
        'page_content' => $page_content,
        'massiv_category' => $massiv_category,
        'massiv_users' =>$massiv_users,
        'title' => 'Регистрация',
        'user' => $user
    ]);

    print($layout_content);
}
else
{
    $date_main = ['massiv_category' => $massiv_category,'error' => $error, 'message' => $message, 'form' => $form,'user' => $user];

    $page_content = include_template('signup.php', $date_main);
    $layout_content = include_template('layout.php', [
        'page_content' => $page_content,
        'massiv_category' => $massiv_category,
        'massiv_users' =>$massiv_users,
        'title' => 'Регистрация',
        'user' => $user
    ]);

    print($layout_content);
}
?>
