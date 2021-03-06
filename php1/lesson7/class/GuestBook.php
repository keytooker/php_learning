<?php

require_once __DIR__ . '/GuestBookRecord.php';
require __DIR__ . '/TextFile.php';

class GuestBook extends TextFile
{
    // В конструктор передается путь до файла с данными гостевой книги, в нём же происходит
    // чтение данных из ней (используйте защищенное свойство объекта для хранения данных)
    public function __construct(string $guestBookPath)
    {
        $this->filePath = $guestBookPath;
        $this->loadAllRecords($guestBookPath);
    }

    protected function loadAllRecords(string $guestBookPath)
    {
        $lines = file($guestBookPath, FILE_IGNORE_NEW_LINES);
        $records = [];

        foreach ($lines as $line)
        {
            $records[] = new GuestBookRecord($line);
        }

        $this->content = $records;
    }


}

