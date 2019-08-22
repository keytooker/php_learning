<pre>
    Урок 80. Объекты в другом классе
</pre>
<pre>
     Самостоятельно повторите описанные мною классы Arr и SumHelper.
</pre>
<pre>
Задача :

Создайте класс AvgHelper с методом getAvg, который параметром будет принимать массив и возвращать среднее арифметическое
    этого массива (сумма элементов делить на количество).

Задача :

Добавьте в класс AvgHelper еще и метод getMeanSquare, который параметром будет принимать массив и возвращать среднее
    квадратичное этого массива (квадратный корень, извлеченный из суммы квадратов элементов, деленной на количество).

Задача :

Добавьте в класс Arr метод getAvgMeanSum, который будет находить сумму среднего арифметического и среднего квадратичного из массива $this->nums.

</pre>
<?php

class Arr
{
    public function __construct() {
        $this->sum_helper = new SumHelper;
        $this->avg_helper = new AvgHelper;
    }

    public function  add($elem)
    {
        $this->nums[] = $elem;
    }

    public function sum23()
    {
        $sum = $this->sum_helper->sum2($this->nums);
        $sum += $this->sum_helper->sum3($this->nums);
        return $sum;
    }

    public function get_avg_mean_sum()
    {
        return ($this->avg_helper->get_avg($this->nums) + $this->avg_helper->get_mean_square($this->nums));
    }

    private $nums = [];
    private $sum_helper;
    private $avg_helper;
}

class SumHelper
{
    public function sum2($arr)
    {
        return $this->sum_pow($arr, 2);
    }

    public function sum3($arr)
    {
        return $this->sum_pow($arr, 3);
    }

    private function sum_pow($arr, $p)
    {
        $sum = 0;
        foreach ($arr as $item)
            {
                $sum += pow($item, $p);
            }

        return $sum;
    }
}

$a = new Arr;
$a->add(2);
$a->add(2);
$a->add(2);

echo $a->sum23();

class AvgHelper
{
    public function get_avg($arr)
    {
        $sum = 0;

        foreach ($arr as $item)
        {
            $sum += $item;
        }

        return ($sum / sizeof($arr));
    }

    public function get_mean_square($arr)
    {
        $result = 0;
        $sum = 0;

        foreach ($arr as $item) {
            $sum += pow($item, 2);
        }
        $result = $sum / sizeof($arr);
        $result = sqrt($result);
        return $result;
    }
}

$ah = new AvgHelper;
$arr = [1, 2, 3];
echo $ah->get_avg($arr);

echo $a->get_avg_mean_sum();