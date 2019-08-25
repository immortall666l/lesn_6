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
        //составляем имя файла
        $this->setFileName();
    }

    //3.2 Метод isUploaded() проверяет - был ли загружен файл от данного имени поля
    public function isUploaded() {
        //проверяем массив $_FILES на элемент с ключем который мы ожидаем от формы
        if (isset($_FILES[$this->area_name])) {
            return true;
        } else {
            return false;
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
            return false;
        }
    }

    //Метод составляет имя файла
    protected function setFileName()
    {
        $filename = $_FILES[$this->area_name]['name'];
        $this->final_filename = __DIR__.'/../img/'.time().$filename;
    }

}