<pre>
    Урок 105. Трейты в трейтах.
</pre>
<p>
    Самостоятельно сделайте такие же трейты, как у меня и подключите их к классу Test. Сделайте в этом классе метод
    getSum, возвращающий сумму результатов методов подключенных трейтов.
</p>
<?php
trait Trait1
{
    public function method1()
    {
        return 1;
    }

    public function method2()
    {
        return 2;
    }
}

trait Trait2
{
    use Trait1;

    public function method3()
    {
        return 3;
    }
}

class Test
{
    use Trait2;

    public function getSum()
    {
        $sum = $this->method1() + $this->method2() + $this->method3();
        return $sum;
    }
}

$test = new Test;
echo $test->getSum();