<pre>
    Урок 86. Статические свойства.
</pre>
<p>
    Сделайте класс Num, у которого будут два публичных статических свойства: num1 и num2. Запишите в первое свойство
    число 2, а во второе - число 3. Выведите сумму значений свойств на экран.
</p>
<?php
class Num
{
    public static $num1 = 0;
    public static $num2 = 0;
}

Num::$num1 = 2;
Num::$num2 = 3;
echo Num::$num1 + Num::$num2;
?>
<p>
    Сделайте класс Num, у которого будут два приватны статических свойства: num1 и num2.
    Пусть по умолчанию в свойстве num1 хранится число 2, а в свойстве num2 - число 3.


    Сделайте в классе Num метод getSum, который будет выводить на экран сумму значений свойств num1 и num2.

</p>
<?php
class Num2
{
    public static function getSum()
    {
        echo self::$num1 + self::$num2;
    }
 private static $num1 = 2;
 private static $num2 = 3;
}

echo Num2::getSum();
?>

<p>
    Добавьте в наш класс Geometry метод, который будет находить объем шара по радиусу. С помощью этого метода выведите
    на экран объем шара с радиусом 10.
</p>
<?php
class Geometry
{
private static $pi = 3.14; // вынесем Пи в свойство

public static function getCircleSquare($radius)
{
return self::$pi * $radius * $radius;
}

public static function getCircleСircuit($radius)
{
return 2 * self::$pi * $radius;
}

public static function getVS($radius)
{
    return 4 * self::$pi * pow($radius, 3) / 3;
}
}

echo Geometry::getVS(10);