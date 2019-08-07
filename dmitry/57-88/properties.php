<?php
/**
 *  Сделайте класс Employee (работник), в котором будут следующие свойства - name (имя), age (возраст), salary (зарплата).

Задача :

Создайте объект класса Employee, затем установите его свойства в следующие значения - имя 'Иван', возраст 25, зарплата
 * 1000.

Задача :

Создайте второй объект класса Employee, установите его свойства в следующие значения - имя 'Вася', возраст 26,
 * зарплата 2000.

Задача :

Выведите на экран сумму зарплат Ивана и Васи.

Задача :

Выведите на экран сумму возрастов Ивана и Васи.

 */

class Employee
{
    public $name;
    public $salary;
    public $age;
}

$employee = new Employee;
$employee->age = 25;
$employee->salary = 1000;
$employee->name = 'Иван';

$employee2 = new Employee;
$employee2->age = 26;
$employee2->salary = 2000;
$employee2->name = 'Вася';

echo 'Сумма зарплат ' . (string)($employee->salary + $employee2->salary);
echo '<pre></pre>';
echo 'Сумма возрастов ' . (string)($employee->age + $employee2->age);
