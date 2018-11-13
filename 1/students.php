<?php

/**
 * Задача 1
 */


interface iUser
{
    public function setName($name); // установить имя
    public function getName(); // получить имя
    public function setAge($age); // установить возраст
    public function getAge(); // получить возраст
}

/**
 * Class Students
 * Сделайте класс Students, который будет реализовывать интерфейс iUser.
 */
class Students
    implements iUser
{
    public function setName($name) // установить имя
    {
        $this->name = $name;
    }

    public function getName(): string // получить имя
    {
        return $this->name;
    }

    public function setAge($age) // установить возраст
    {
        $this->age = $age;
    }

    public function getAge(): int // получить возраст
    {
        return $this->age;
    }

    protected $age;
    protected $name;
}

$stud = new Students();
$stud->setAge(21);
$stud->setName('Иван Петров');

// echo $stud->getName() . ' ' . $stud->getAge();