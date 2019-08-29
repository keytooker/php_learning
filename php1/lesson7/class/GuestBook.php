<?php
//
// GuestBook.php
//

require_once __DIR__ . '/GuestBookRecord.php';

class GuestBook
{
    public function getAllRecords()
    {
        $lines = file(__DIR__ . '/../guestbook.txt', FILE_IGNORE_NEW_LINES);
        $ret = [];

        foreach ($lines as $line)
        {
            $ret[] = new GuestBookRecord($line);
        }

        return $ret;
    }
}