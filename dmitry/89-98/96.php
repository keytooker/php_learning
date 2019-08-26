<pre>
    Урок 96. Реализация нескольких интерфейсов.
</pre>
<p>
 	Задача 1. Сделайте так, чтобы класс Rectangle также реализовывал два интерфейса Figure и Tetragon.
 </p>
 <?php
 interface Figure
 {
 	public function getSquare();
 	public function getPerimeter();
 }

 interface Tetragon
 {
 	public function getA();
 	public function getB();
 	public function getC();
 	public function getD();
 }

 class Rectangle implements Tetragon, Figure
 {
 	public function __construct($a, $b)
 	{
 		$this->a = $a;
 		$this->b = $b;
 	}

 	public function getA()
 	{
 		return $this->a;
 	}

 	public function getB()
 	{
 		return $this->b;
 	}

 	public function getC()
 	{
 		return $this->a;
 	}

 	public function getD()
 	{
 		return $this->b;
 	}

 	public function getSquare()
 	{
 		$square = $this->a * $this->b;
 		return $square;
 	}

 	public function getPerimeter()
 	{
 		$perimeter = 2 * ($this->a + $this->b);
 		return $perimeter;
 	}


 	private $a = 0;
 	private $b = 0;
 }

$rectangle = new Rectangle(4, 5);
echo 'Периметр: ' . $rectangle->getPerimeter() . ' Площадь: ' . $rectangle->getSquare();
?>

<p>
	Задача 2. Сделайте интерфейс Circle (круг) с методами getRadius (получить радиус) и getDiameter(получить диаметр)
</p>
<?php
interface Circle
{
	public function getRadius();
	public function getDiameter();
}
?>
<p>
	Задача 3. Сделайте так, чтобы класс Disk также реализовывал два интерфейса: и Figure, и Circle.
</p>
<?php
class Disk implements Circle, Figure
{
	public function __construct($radius)
	{
		$this->radius = $radius;
	}

 	public function getSquare()
 	{
 		$square = 2 * self::PI * pow($this->radius, 2); 
 		return $square;
 	}

 	public function getPerimeter()
 	{
 		$p = 2 * self::PI * pow($this->radius, 2);
 		return $p;
 	}

 	public function getRadius()
 	{
 		return $this->radius;
 	}
	public function getDiameter()
	{
		return 2 * $this->radius;
	}

	private $radius;
	private const PI = 3.14;
}

$disk = new Disk(10);
echo 'Площадь: ' . $disk->getSquare() . ' Длина окружности: ' . $disk->getPerimeter() . ' Радиус: ' . $disk->getRadius . ' Диаметр: ' . $disk->getDiameter();
?>








