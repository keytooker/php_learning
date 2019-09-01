<?php

class Uploader
{
    // В конструктор передается имя поля формы, от которого мы ожидаем загрузку файла
    public function __construct($fieldName)
    {
        $this->fieldName = $fieldName;
    }

    // Метод isUploaded() проверяет - был ли загружен файл от данного имени поля
    public function isUploaded()
    {
       if ( isset($_FILES[$this->fieldName]) && ( 0 == $_FILES[$this->fieldName]['error'] ) )
       {
           return true;
       }
       else
       {
           return false;
       }
    }

    // Метод upload() осуществляет перенос файла (если он был загружен!) из временного места
    // в постоянное
    public function upload()
    {
        if ($this->isUploaded())
        {
            $uploaddir = __DIR__ . '/uploads/';
            $uploadfile = $uploaddir . basename($_FILES[$this->fieldName]['name']);

            if (move_uploaded_file($_FILES[$this->fieldName]['tmp_name'], $uploadfile))
            {
                return true; // Файл корректен и был успешно загружен.
            }
            else
            {
                return false;
            }
        }
    }

    protected $fieldName;
}
