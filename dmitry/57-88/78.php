Сделайте класс User, в котором будут следующие свойства только для чтения: name (имя), surname (фамилия),
Начальные значения этих свойств должны устанавливаться в конструкторе. Сделайте также геттеры этих свойств.

Задача :

Сделайте так, чтобы третьим параметром в конструктор передавалась дата рождения работника в формате год-месяц-день
Запишите ее в свойство birthday. Сделайте геттер для этого свойства.

Задача :

Сделайте приватный метод calculateAge, который параметром будет принимать дату рождения, а возвращать возраст с учетом
того, был ли уже день рождения в этом году, или нет.

Задача :

Сделайте так, чтобы метод calculateAge вызывался в конструкторе объекта, рассчитывал возраст пользователя и записывал
его в приватное свойство age. Сделайте геттер для этого свойства.



<?php
class User
{
    public function __construct($name, $surname, $birthday)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->birthday = $birthday;
        $this->age = $this->calculate_age($this->birthday);
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_surname()
    {
        return $this->surname;
    }

    public function get_birthday()
    {
        return $this->birthday;
    }

    public function get_age()
    {
        return $this->age;
    }

    private function calculate_age($birthday)
    {
        $age = date_diff(date_create($birthday), date_create('now'))->y;
        return $age;
    }

    private $name;
    private $surname;
    private $birthday;
    private $age;
}

$user = new User('Mi', 'Vi', '1986-10-10');
echo $user->get_age();
?>
<pre>
Сделайте класс Employee, который будет наследовать от класса User. Пусть новый класс имеет свойство salary,
в котором будет хранится зарплата работника. Зарплата должна передаваться четвертым параметром в конструктор объекта.
Сделайте также геттер для этого свойства.
</pre>
<?php

class Employee extends User
{
    public function __construct($name, $surname, $birthday, $salary)
    {
        parent::__construct($name, $surname, $birthday);

        $this->salary = $salary;
    }

    public function get_salary()
    {
        return $this->salary;
    }

    private $salary;
}

$e = new Employee('Jaki', 'Chan', '1960-05-03', 300000);
echo $e->get_salary();