<?php

class View
{
    public function getData()
    {
        return $this->data;
    }

    public function display($template)
    {
        include $template;
    }

    public function render($template)
    {
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function add($key, $value)
    {
        $this->data[$key] = $value;
    }

    protected $data = [];
}