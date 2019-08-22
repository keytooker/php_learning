<pre>Урок 92. Параметры методов в интерфейсе.</pre>
<?php
interface iUser
{
    public function setName($name); // установить имя
    public function getName(); // получить имя
    public function setAge($age); // установить возраст
    public function getAge(); // получить возраст
}
?>
<p>Сделайте класс User, который будет реализовывать данный интерфейс. </p>
<?php
class User implements iUser
{
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    private $name;
    private $age;
}

$user = new User;
$user->setName('Bond');
$user->setAge(40);
echo $user->getName();
echo $user->getAge();