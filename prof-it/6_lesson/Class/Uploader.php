<?php


class Uploader
{
    //3. Создайте класс Uploader в соответствии с требованиями:
    public $area_name;
    public $final_filename;
    //3.1 В конструктор передается имя поля формы, от которого мы ожидаем загрузку файла
    public function __construct($area_name)
    {
        $this->area_name = $area_name;
        //проверяем наличие ошибок
        $this->checkUploadErrors();
        //проверяем расширение
        $this->checkFileExtends();
        //составляем имя файла
        $this->makeFileName();
    }

    //3.2 Метод isUploaded() проверяет - был ли загружен файл от данного имени поля
    public function isUploaded() {
        //проверяем массив $_FILES на наличие данных
        if (!empty($_FILES)) {
            //проверяем массив $_FILES на элемент с ключем который мы ожидаем от формы
            if (isset($_FILES[$this->area_name])) {
                return true;
            } else {
                return false;
            }
        }
    }

    //3.3 Метод upload() осуществляет перенос файла (если он был загружен!) из временного места в постоянное
    public function upload()
    {
        if ( $this->isUploaded() ) {
            //если файл был загружен из нужного нам поля, то перемещаем его в нужную нам директорию
            move_uploaded_file(
                $_FILES[$this->area_name]['tmp_name'],
                $this->final_filename
            );
            return true;
        } else {
            echo 'Файл не загружен!';
        }
    }

    //Метод проверяет загрузку на наличие ошибок
    protected function checkUploadErrors()
    {
        if (0 == $_FILES[$this->area_name]['error']) {
            return true;
        }
    }

    //Метод проверяет файл на нужное нам расширение
    protected function checkFileExtends()
    {
        //проверяем файл на нужное нам расширение
        $extends =  ['png' ,'jpg'];
        $file_extend = pathinfo($_FILES[$this->area_name]['name'], PATHINFO_EXTENSION);
        if( !in_array($file_extend, $extends) ) {
            echo 'Пожалуйста, добавьте изображение в формате PNG или JPG';
            die;
        } else {
            return true;
        }
    }

    //Метод составляет имя файла
    protected function makeFileName()
    {
        //берем имя файла
        $filename = $_FILES[$this->area_name]['name'];
        //составляем полное имя файла
        $destination = __DIR__.'/../img/'.$filename;
        //вызываем метод проверки существования файла с таким же именем
        if ( $this->scanName($destination, $filename) ) {
            //если такого файла нет то записываем имеющееся имя
            $this->final_filename = $destination;
        }
    }

    //Метод проверяет существует ли файл с таким именем
    protected function scanName($destination, $filename)
    {
        if ( file_exists($destination) ) {
            //если есть файл с идентичным именем, то составляем новое уникальное имя
            $new_name = __DIR__.'/../img/'.time().$filename;
            $this->final_filename = $new_name;
        } else {
            return true;
        }
    }

}