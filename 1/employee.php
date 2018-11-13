<?php
/**
    Задача 2
    Сделайте интерфейс iUser, который будет описывать юзера.

    Предполагается, что у юзера будет имя и возраст и эти поля будут передаваться параметрами конструктора.

    Пусть ваш интерфейс также задает то, что у юзера будут геттеры (но не сеттеры) для имени и возраста.
 *
    3адача 3. Сделайте интерфейс iEmployee, наследующий от интерфейса iUser и добавляющий в него методы getSalary и setSalary.
    Сделайте класс Employee, реализующий интерфейс iEmployee.
 */

interface iUser
{
    public function __construct($name, $age);
    public function getName(): string ; // получить имя
    public function getAge(): int; // получить возраст
}

interface iEmployee
    extends iUser
{
    public function getSalary(): int;
    public function setSalary($salary);
}

class Employee
    implements iEmployee
{
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName(): string // получить имя
    {
        return $this->name;
    }

    public function getAge(): int // получить возраст
    {
        return $this->age;
    }

    public function getSalary(): int
    {
        return $this->salary;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    protected $age;
    protected $salary;
    protected $name;
}

/*
$e = new Employee('Иван Иванович', 56);
$e->setSalary(64000);
echo $e->getName(), $e->getAge(), $e->getSalary();
*/