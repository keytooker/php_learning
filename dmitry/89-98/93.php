<pre>
    Урок 93. Объявление конструктора в интерфейсе.
</pre>
<p>
    Сделайте интерфейс iCube, который будет описывать фигуру Куб.

    Пусть ваш интерфейс описывает конструктор, параметром принимающий сторону куба, а также методы для получения объема
    куба и площади поверхности.

</p>
<?php
interface iCube
{
    public function __construct($side);
    public function getVolume();
}
?>

<p>
    Сделайте класс Cube, реализующий интерфейс iCube.
</p>

<?php
class Cube implements iCube
{
    public function __construct($side)
    {
        $this->side = $side;
    }

    public function getVolume()
    {
        return pow($this->side, 3);
    }

    private $side;
}

$cube = new Cube(2);
echo $cube->getVolume();
?>
<p>
    Сделайте интерфейс iUser, который будет описывать юзера.

    Предполагается, что у юзера будет имя и возраст и эти поля будут передаваться параметрами конструктора.

    Пусть ваш интерфейс также задает то, что у юзера будут геттеры (но не сеттеры) для имени и возраста.

    Сделайте класс User, реализующий интерфейс iUser.
</p>
<?php
interface iUser
{
    public function __construct($name, $age);
    public function getName();
    public function getAge();
}

class User implements iUser
{
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    private $name;
    private $age;
}

$user = new User('Ivan', 12);
echo $user->getName();
echo $user->getAge();