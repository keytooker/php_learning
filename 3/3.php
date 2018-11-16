<?php
/**
 * Задача 1. Создать класс, что бы ма могли
 * сдеалать echo $a->addA()->addB()->addС()->getStr();
 * Результат: abc
 */
class Test
{
    public function addA()
    {
        $this->str = $this->str . 'a';
        return $this;
    }

    public function addB()
    {
        $this->str = $this->str . 'b';
        return $this;
    }

    public function addC()
    {
        $this->str = $this->str . 'c';
        return $this;
    }

    public function getStr()
    {
        return $this->str;
    }

    protected $str;
}

$a = new Test();
echo $a->addA()->addB()->addC()->getStr();



