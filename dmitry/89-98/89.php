<pre>
    Урок 89. Абстрактные классы.

     Добавьте в класс Figure метод getSquarePerimeterSum, который будет находить сумму площади и периметра.
</pre>
<?php
abstract class Figure
{
    abstract public function getSquare();
    abstract public function getPerimeter();
    public function getSquarePerimeterSum()
    {
        $result = $this->getPerimeter() + $this->getSquare();
        return $result;
    }
}
?>
<p>
    Сделайте аналогичный класс Rectangle (прямоугольник), у которого будет два приватных свойства: $a для ширины и $b для длины.

    Данный класс также должен наследовать от класса Figure и реализовывать его методы.


</p>
<?php
class Rectangle extends Figure
{
    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function getSquare()
    {
        return ($this->a * $this->b);
    }

    public function getPerimeter()
    {
        return (2 * $this->a + 2 * $this->b);
    }


    private $a;
    private $b;
}

$r = new Rectangle(3, 10);
echo $r->getSquare();
echo $r->getPerimeter();
echo $r->getSquarePerimeterSum();