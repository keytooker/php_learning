<?php
class GuestBookRecord
{
    public function __construct(string $m)
    {
        $this->message = $m;
    }

    protected $message;
}