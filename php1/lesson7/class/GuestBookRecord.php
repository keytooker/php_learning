<?php

require_once __DIR__ . '/Record.php';

class GuestBookRecord extends Record
{
    public function __construct(string $m)
    {
        $this->message = $m;
    }
}