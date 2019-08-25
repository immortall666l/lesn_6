<?php

    // 1. Для начала создайте несколько полезных функций и выделите их в отдельный файл:
    // -Функция getUsersList() пусть возвращает массив всех пользователей и хэшей их паролей
    // -Функция existsUser($login) проверяет - существует ли пользователь с заданным логином?
    // -Функция сheckPassword($login, $password) пусть возвращает true тогда, когда существует пользователь с указанным логином и введенный им пароль прошел проверку

    // Стартуем сессию
    session_start();

    if (!empty($_POST)) {
        $login = $_POST['login'];
        $password = $_POST['password'];

//        var_dump($_POST);

        $users = getUsersList();
        existsUser($login, $users);
        $home = checkPassword($login, $password, $users);

        // при прохождении аутентификации направляем на главную
        if ( $home ) {
            header('Location: /6_lesson/index.php');
            exit;
        }
    }

    // Функция getUsersList() возвращает массив всех пользователей и хэшей их паролей

    function getUsersList() {
        //подключаем файл, который возвращает нам массив с логинами и хэшами паролей
        return include __DIR__.'/users.php';
    }

    //проверяем - существует ли пользователь с заданным логином (проходим идентификацию)
    function existsUser($login, $users) {
        //проверяем существует ли переменная $login и не пуста ли она
        if (isset($login) && !empty($login) ) {
            //проверяем существует ли в массиве $users пользователь с ключем(логином) таким как в передаваемой переменной $login
            if ( array_key_exists($login, $users) ) {
                //echo 'Пользователь существует!';
            } else {
                echo 'Извините, пользователь с данным логином не существует!';
            }
        } else {
            echo 'Данных о логине нет!';
        }
    }

    // проверяем существует ли пользователь с указанным логином и введенный им паролем (проходим аутентификацию)
    function checkPassword($login, $password, $users) {
        //проверяем существует ли переменная $password и не пуста ли она
        if (isset($password) && !empty($password) ) {
            //проверяем соответствуют ли данные полученные от пользователя хэшу пароля
            if ( password_verify ( $password, $users[$login] ) ) {
                //echo 'Успех!';
                $_SESSION['login'] = $login;
                return true;
            } else {
                echo 'Пароль не соответствует! попробуйте снова!';
            }

        } else {
            echo 'Данных о пароле нет!';
        }
    }



    // 2. Добавьте функцию getCurrentUser() которая возвращает либо имя вошедшего на сайт пользователя, либо null
    function getCurrentUser() {
        if ( isset($_SESSION['login']) && !empty($_SESSION['login']) ) {
            //echo 'Зашел пользователь '.$_SESSION['login'];
            return $_SESSION['login'];
        } else {
            return null;
        }
    }