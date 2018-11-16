<?php
/**
 * Задача 2. Создать класс Car, в конструкторе будут свойства color, year, manufacture
 * метод - start_engine(), stop_engine()
 *
 * создать class Engine
 * методы - on и off
 * внедрить завимость, чтобы можно было использовать в методах start_engine(), stop_engine() методы on и off
 */

class Engine
{
    public function on()
    {
        echo 'Engine on';
    }

    public function off()
    {
        echo 'Engine off';
    }
}

class Car
{
    public function __construct($color, $year, $manufacture)
    {
        $this->engine = new Engine();
        $this->color = $color;
        $this->year = $year;
        $this->manufacture = $manufacture;
    }

    public function start_engine()
    {
        $this->engine->on();
    }

    public function stop_engine()
    {
        $this->engine->off();
    }

    private $engine;
    private $color;
    private $year;
    private $manufacture;
}

/*
$car = new Car('red', 2010, 'Lada');
$car->start_engine();
$car->stop_engine();
*/