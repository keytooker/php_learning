<pre>
    Урок 94. Наследование интерфейсов
</pre>
<p>
    Сделайте интерфейс iUser с методами getName, setName, getAge, setAge.

    Задача :

    Сделайте интерфейс iEmployee, наследующий от интерфейса iUser и добавляющий в него методы getSalary и setSalary.

    Задача :

    Сделайте класс Employee, реализующий интерфейс iEmployee.
</p>
<?php
interface iUser
{
    public function getName();
    public function getAge();
    public function setAGe($age);
    public function setName($name);
}

interface iEmployee extends iUser
{
    public function getSalary();
    public function setSalary($salary);
}

class Employee implements iEmployee
{
    public function getName()
    {
        return $this->name;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function setAge($age)
    {
        $this->age = $age;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getSalary()
    {
        return $this->salary;
    }
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    private $name;
    private $age;
    private $salary;
}

$e = new Employee;
$e->setName('Petrenko');
$e->setAge(44);
$e->setSalary(2200);
echo $e->getName() . ' ' . $e->getAge() . ' ' . $e->getSalary();