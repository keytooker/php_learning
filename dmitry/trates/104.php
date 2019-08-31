<pre>
    Урок 104. Абстрактные методы трейтов
</pre>
<p>
    Скопируйте код моего трейта TestTrait и код моего класса Test. Удалите из класса метод method2.
    Убедитесь в том, что отсутствие его реализации приведет к ошибке PHP.
</p>
<?php
trait TestTrait
{
    public function method1()
    {
        return 1;
    }

    // Абстрактный метод:
    abstract public function method2();
}

class Test
{
    use TestTrait; // используем трейт

    // Реализуем абстрактный метод:
    //public function method2()
    //{
       // return 2;
    //}
}

$test = new Test;
echo $test->method1();