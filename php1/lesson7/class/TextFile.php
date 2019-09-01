<?php

require_once __DIR__ . '/Record.php';

class TextFile
{
    public function save()
    {
        if ($this->filePath === '')
        {
            return;
        }

        $text = '';
        foreach ($this->content as $record)
        {
            $text .= $record->getMessage() . PHP_EOL;
        }

        if ( file_put_contents($this->filePath,  $text) !== false )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getData()
    {
        return $this->content;
    }

    public function append(Record $record)
    {
        $this->content[] = $record;
    }


    protected $content = [];
    protected $filePath = '';
}