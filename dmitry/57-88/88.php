<pre>Урок 88</pre>
<p>
    Реализуйте предложенный класс Circle самостоятельно.


    С помощью написанного класса Circle найдите длину окружности и площадь круга с радиусом 10.

</p>
<?php
class Circle
{
    const PI = 3.14; // запишем число ПИ в константу
    private $radius; // радиус круга

    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    // Найдем площадь:
    public function getSquare()
    {
        return (self::PI * pow($this->radius, 2)); // Пи умножить на квадрат радиуса
    }

    // Найдем длину окружности:
    public function getCircuit()
    {
        return (2 * self::PI * $this->radius); // 2 Пи умножить на радиус
    }
}

$circle = new Circle(10);
echo $circle->getSquare();
echo $circle->getCircuit();