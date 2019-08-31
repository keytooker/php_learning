<?php

//
// * Продумайте - какие части функционала можно вынести в базовый (родительский) класс TextFile,
// а какие - сделать в унаследованном от него классе GuestBook
//

class TextFile
{
    public function save()
    {
        $file = __DIR__ . '/new_guestbook.txt';
        file_put_contents($file, $this->content);
    }

    public function getData()
    {
        return $this->content;
    }

    public function setData($data)
    {
        $this->content = $data;
    }

    protected $content;
}

class ExtGuestBook extends TextFile
{
    public function __construct($guestBookPath)
    {
        $this->setData(file($guestBookPath));
    }

    // Метод append($text) добавляет новую запись к массиву записей
    public function append($text)
    {
        $data = $this->getData();
        $data[] = $text;
        $this->setData($data);
    }
}