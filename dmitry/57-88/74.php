<p>Напишите реализацию методов класса ArrayAvgHelper, заготовки методов которого расположены ниже:</p>
<?php
class ArraySumHelper
{
    /*
        Находит сумму первых
        степеней элементов массива:
    */
    public function getAvg1($arr)
    {
        return $this->getSum($arr, 1);
    }

    /*
        Находит сумму вторых степеней
        элементов массива и извлекает
        из нее квадратный корень:
    */
    public function getAvg2($arr)
    {
        $power = 2;
        $sum2 = $this->getSum($arr, $power);
        return $this->calcSqrt($sum2, $power);
    }

    /*
        Находит сумму третьих степеней
        элементов массива и извлекает
        из нее кубический корень:
    */
    public function getAvg3($arr)
    {
        $power = 3;
        $sum2 = $this->getSum($arr, $power);
        return $this->calcSqrt($sum2, $power);
    }

    /*
        Находит сумму четвертых степеней
        элементов массива и извлекает
        из нее корень четвертой степени:
    */
    public function getAvg4($arr)
    {
        $sum4 = $this->getSum($arr, 4);
        return $this->calcSqrt($sum4, 4);
    }

    /*
        Вспомогательный метод, который параметром
        принимает массив и степень и возвращает
        сумму степеней элементов массива:
    */
    private function getSum($arr, $power)
    {
        $sum = 0;
        foreach ($arr as $elem)
        {
            $sum += pow($elem, $power);
        }
        return $sum;
    }

    /*
        Вспомогательный метод, который параметром
        принимает целое число и степень и возвращает
        корень заданной степени из числа:
    */
    private function calcSqrt($num, $power)
    {
        $p = 1/$power;
        return pow($num, $p);
    }
}
