<?php

require_once __DIR__ . '/TextFile.php';
require_once __DIR__ . '/Article.php';

class News extends TextFile
{
    // В конструктор передается путь до файла с данными гостевой книги, в нём же происходит
    // чтение данных из ней (используйте защищенное свойство объекта для хранения данных)
    public function __construct(string $newsPath)
    {
        $this->filePath = $newsPath;
        $this->loadAllRecords($newsPath);
    }

    protected function loadAllRecords(string $newsPath)
    {
        $lines = file($newsPath, FILE_IGNORE_NEW_LINES);
        $records = [];

        foreach ($lines as $line)
        {
            $records[] = new Article($line);
        }

        $this->content = $records;
    }

}