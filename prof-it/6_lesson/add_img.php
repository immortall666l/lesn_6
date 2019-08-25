<?php
    // Стартуем сессию
    session_start();

    require __DIR__ . '/Class/Uploader.php';
    include __DIR__.'/filename.php';

    $area_name = 'addimg';

    //Создаем объект класса Uploader
    $upload_img = new Uploader($area_name);
    //осуществляем перенос файла
    $upload_img->upload();

    //делаем запись в лог. Записываем данные из лога в массив
    $add_to_file = $logbook;
    $add_to_file[] = date("d.m.y").': пользователь '.$_SESSION['login'].' загрузил изображение '.$upload_img->final_filename;
    //echo date("d.m.y").': Пользователь '.$_SESSION['login'].' загрузил изображение '.$good_filename;
    //добавляем в файл новые данные
    file_put_contents($dir, implode("\n", $add_to_file));


    header('Location: /6_lesson/index.php');
    exit;
