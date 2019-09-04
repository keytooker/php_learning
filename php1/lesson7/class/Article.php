<?php

require_once __DIR__ . '/Record.php';

class Article extends Record
{
    public function __construct(string $m)
    {
        $this->message = $m;
    }
}