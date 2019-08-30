<?php
class GuestBookRecord
{
    public function __construct(string $m)
    {
        $this->message = $m;
    }

    public function getMessage()
    {
        return $this->message;
    }

    protected $message;
}