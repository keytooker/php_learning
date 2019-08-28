<?php

class GuestBook
{
    // В конструктор передается путь до файла с данными гостевой книги, в нём же происходит
    // чтение данных из ней (используйте защищенное свойство объекта для хранения данных)
    public function __construct($guestBookPath)
    {
        $this->records = file($guestBookPath);
    }

    // Метод save() сохраняет массив в файл
    public function save()
    {
        $file = __DIR__ . '/new_guestbook.txt';
        file_put_contents($file, $this->records);
    }

    // Метод getData() возвращает массив записей гостевой книги
    public function getData()
    {
        return $this->records;
    }

    // Метод append($text) добавляет новую запись к массиву записей
    public function append($text)
    {
        $this->records[] = $text;
        return $this;
    }

    protected $records;
}

