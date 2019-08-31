<pre>
     Урок 95. Интерфейсы instanceof
</pre>
<p>
    Сделайте интерфейс Figure3d (трехмерная фигура), который будет иметь метод getVolume (получить объем) и метод
    getSurfaceSquare (получить площадь поверхности).
</p>

<?php
interface Figure3d
{
    public function getVolume();
    public function getSurfaceSquare();
}
?>

<p>
    Сделайте класс Cube (куб), который будет реализовывать интерфейс Figure3d.
</p>
<?php
class Cube implements Figure3d
{
    public function __construct($edge)
    {
        $this->edge = $edge;
    }

    public function getVolume()
    {
        $volume = pow($this->edge, 3);
        return $volume;
    }

    public function getSurfaceSquare()
    {
        $s = 6 * pow($this->edge, 2);
        return $s;
    }

    private $edge = 0;
}

$cube = new Cube(2);
echo 'Объем: ' . $cube->getVolume() . ', площать поверхности: ' . $cube->getSurfaceSquare();
?>

<p>
    Создайте несколько объектов класса Quadrate, несколько объектов класса Rectangle и несколько объектов класса Cube.
    Запишите их в массив $arr в случайном порядке.
</p>
<?php
$arr[] = $cube;
interface Figure
{
    public function getS();
}

class Quadrate implements Figure
{
    public function __construct($side)
    {
        $this->side = $side;
    }
    public function getS()
    {
        return pow($this->side, 2);
    }

    private $side;
}

$quadrate1 = new Quadrate(2);
$arr[] = $quadrate1;
$quadrate2 = new Quadrate(4);
$arr[] = $quadrate2;
$cube3 = new Cube(3);
$arr[] = $cube3;
$cube1 = new Cube(1);
$arr[] = $cube1;
$quadrate3 = new Quadrate(10);
$arr[] = $quadrate3;
?>
<p>
    Переберите циклом массив $arr и выведите на экран только площади объектов реализующих интерфейс Figure.

    Переберите циклом массив $arr и выведите для плоских фигур их площади, а для объемных - площади их поверхности.

</p>
<?php
foreach ($arr as $item)
{
    if ($item instanceof Figure)
    {
        echo $item->getS() . ' | ';
    }

    if ($item instanceof Figure3d)
    {
        echo $item->getSurfaceSquare() . ' | ';
    }
}
