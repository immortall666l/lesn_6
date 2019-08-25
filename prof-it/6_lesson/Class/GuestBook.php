<?php


class GuestBook extends TextFile
{
    // 1. Создайте класс GuestBook, который будет удовлетворять следующим требованиям:

    protected $data;
    public $src;

    // 1.1 В конструктор передается путь до файла с данными гостевой книги, в нём же происходит чтение данных из ней (используйте защищенное свойство объекта для хранения данных)
    public function __construct($src)
    {
        $this->src = $src;

        //проверям существует ли файл
        $file = file_exists($src);
        if ( $file ) {
            //получаем массив записей и ставим флаг пропускать новую строку в конце каждого элемента массива
            $this->data = file($src, FILE_IGNORE_NEW_LINES);
        } else {
            echo 'Файл не существует!';
        }
    }

    // 1.2 Метод getData() возвращает массив записей гостевой книги
    public function getData()
    {
        return $this->data;
    }

    // 1.3 Метод append($text) добавляет новую запись к массиву записей
    public function append($text)
    {
        $this->data[] = $text;
        $this->save();
    }

    // 1.4 Метод save() сохраняет массив в файл
    public function save()
    {
        file_put_contents($this->src, implode("\n", $this->data));

    }

}

