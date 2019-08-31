<?php
//
// GuestBook.php
//

require_once __DIR__ . '/GuestBookRecord.php';

class GuestBook
{
    public function __construct()
    {
        $this->loadAllRecords();
    }

    protected function loadAllRecords()
    {
        $lines = file(__DIR__ . '/../guestbook.txt', FILE_IGNORE_NEW_LINES);
        $records = [];

        foreach ($lines as $line)
        {
            $records[] = new GuestBookRecord($line);
        }

        $this->records = $records;
    }

    public function getAllRecords()
    {
        return $this->records;
    }

    public function addRecord( GuestBookRecord $record )
    {
        $this->records[] = $record;
    }

    protected $records = [];
}