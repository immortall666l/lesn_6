<?php

    require __DIR__ . '/Class/GuestBook.php';

    //записываем имя файла в переменную
    $src = __DIR__.'/guestbook.txt';
    $text = $_POST['text'];

    $guestbook = new GuestBook($src);
    $guestbook->append($text);

    //перенаправляем на главную страницу гостевой книги
    header('Location: /6_lesson/index.php');
    exit;