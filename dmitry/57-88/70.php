<?php

/**
 * lesson 70
 *  Сделайте класс City (город), в котором будут следующие свойства - name (название), foundation (дата основания),
 * population (население). Создайте объект этого класса.

Задача :

Пусть дана переменная $props, в которой хранится массив названий свойств класса City. Переберите этот массив циклом
 * foreach и выведите на экран значения соответствующих свойств.

 */

class City
{
    public function __construct($name, $foundation, $population)
    {
        $this->name = $name;
        $this->foundation = $foundation;
        $this->population = $population;
    }

    public $name;
    public $foundation;
    public $population;
}

$voronezh = new City('Воронеж', 1586, 900000);

$props = ['name', 'foundation', 'population'];
foreach ($props as $prop) {
    echo $voronezh->$prop;
}

/*
 * Скопируйте мой код класса User и массив $props. В моем примере на экран выводится фамилия юзера. Выведите еще и имя, и отчество.
 */

class User
{
    public function __construct($surname, $name, $patronymic)
    {
        $this->patronymic = $patronymic;
        $this->name = $name;
        $this->surname = $surname;
    }

    public $surname;
    public $name;
    public $patronymic;
}

$props = ['surname', 'name', 'patronymic'];
$user = new User('Вислогузов', 'Михаил', 'Александрович');
?>
<pre>
    <?php
echo $user->{$props[0]};
echo $user->{$props[1]};
echo $user->{$props[2]};
?>
    </pre>
