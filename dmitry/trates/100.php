<pre>
    Урок 100. Несколько трейтов.
</pre>
<p>
    Сделайте 3 трейта с названиями Trait1, Trait2 и Trait3. Пусть в первом трейте будет метод method1, возвращающий 1,
    во втором трейте - метод method2, возвращающий 2, а в третьем трейте - метод method3, возвращающий 3.
    Пусть все эти методы будут приватными.
</p>
<?php
    trait Trait1
    {
        private function method1()
        {
            return 1;
        }
    }

trait Trait2
{
    private function method2()
    {
        return 2;
    }
}

trait Trait3
{
    private function method3()
    {
        return 3;
    }
}
?>

<p>
    Сделайте класс Test, использующий все три созданных нами трейта. Сделайте в этом классе публичный метод getSum,
    возвращающий сумму результатов методов подключенных трейтов.

</p>
<?php
class Test
{
    use Trait1, Trait2, Trait3;

    public function getSum()
    {
        $sum = $this->method3() + $this->method2() + $this->method1();
        return $sum;

    }
}

$test = new Test();
echo $test->getSum();