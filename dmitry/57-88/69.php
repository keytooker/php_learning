<?php

/**
 * 69.php
 *
 * Начальные значения свойств при объявлении
 */

/*
 *  Реализуйте класс Arr, похожий на тот, который я реализовал выше.
 *  В отличие от моего класса метод add вашего класса параметром должен принимать массив чисел. Все числа из этого
 *  массива должны добавляться в конец массива $this->numbers.
 *
 *  Вместо метода getSum реализуйте метод getAvg, который будет находить среднее арифметическое переданных чисел.
 */

class Arr
{
    private $numbers = [];

    public function add($new_part = [])
    {
        $this->numbers = array_merge($this->numbers, $new_part);
    }

    public function get_sum()
    {

    }

    public function get_numbers_str()
    {
        return implode(', ', $this->numbers);
    }

    public function get_avg()
    {
        $sum = 0;
        $count = sizeof($this->numbers);
        foreach ($this->numbers as $num)
        {
            $sum = $sum + $num;
        }

        return $sum / $count;
    }
}