<?php

// 3. Добавьте к проекту страничку login.php, которая:
//	-ЕСЛИ пользователь уже вошел (см. пункт 2), ТО редирект на главную страницу
//	-ЕСЛИ пользователь не вошел - отображает форму входа
//	-ЕСЛИ введены данные в форму входа - проверяем им (см. пункт 1.3) и ЕСЛИ проверка прошла, ТО запоминаем информацию о вошедшем пользователе


// 4. Модифицируйте ваш проект: позволяйте загружать изображения в галерею только авторизованным пользователям, ведите лог (запись в файл) с данными: кто, когда и какое изображение загрузил


    //подключаем файл с функциями
    include __DIR__.'/functions.php';
    // проверяем вошел ли пользователь на страницу

    if ( getCurrentUser() ) {
        // если пользователь вошел то делаем редирект на главную
        header('Location: /5_lesson/index.php');
        exit;
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница входа</title>
</head>
<body>
    <h2>Введите пожалуйста логин и пароль</h2>
    <form action="/5_lesson/functions.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="login" required>
        <input type="password" name="password" required>
        <button type="submit">Войти</button>
    </form>
</body>
</html>
