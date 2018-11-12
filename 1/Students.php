<?php

/**
 * 5 задач
1) Сделайте класс Students (студенты), в котором будут следующие свойства - name (имя), age (возраст), salary (стипендия).
2)Создайте объект класса Students, затем установите его свойства в следующие значения - имя 'Anton', возраст 25, стипендия 1100.
3)Создайте второй объект класса Students, установите его свойства в следующие значения - имя 'Oleg', возраст 26, стипендия 2200.
4)Вывести на экран сумму стипендий Anton и Oleg
5)Вывести сумму их возрастов
 */


class Students
{
    public $name;
    public $age;
    public $salary;
}

$first = new Students();
$first->name = 'Anton';
$first->age = 25;
$first->salary = 1100;

$second = new Students();
$second->name = 'Oleg';
$second->age = 26;
$second->salary = 2200;

echo 'Сумма стипендий Антона и Олега: ' . ($first->salary + $second->salary);
echo '; ';
echo 'cумма возрастов: ' . ($first->age + $second->age);