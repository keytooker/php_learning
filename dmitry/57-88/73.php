<?php

/*
 *  Не подсматривая в мой код самостоятельно реализуйте такой же класс Arr, методы которого будут вызываться в виде цепочки.

Задача :

Добавьте в класс Arr еще один метод append, который параметром будет принимать массив чисел и добавлять эти числа в
конец массива, хранящегося в объекте.

Предполагается, что методы add и append можно будет использовать в любом порядке:
<?php
	echo (new Arr)->add(1)->append([2, 3, 4])->add(5)->getSum();
?>

Задача :

Сделайте класс User, у которого будут приватные свойства surname (фамилия), name (имя) и patronymic (отчество).

Эти свойства должны задаваться с помощью соответствующих сеттеров.

Сделайте так, чтобы эти сеттеры вызывались цепочкой в любом порядке, а самым последним методом в цепочке можно было
вызвать метод getFullName, который вернет ФИО юзера (первую букву фамилии, имени и отчества).

 */

class Arr
{
    public function add($item)
    {
        $this->arr[] = $item;
        return $this;
    }

    public function get_sum()
    {
        return array_sum($this->arr);
    }

    public function append($a)
    {
        $this->arr = array_merge($this->arr, $a);
        return $this;
    }

    private $arr = [];
}

$arr = new Arr();
$arr->add(1)->add(2);
echo $arr->get_sum();
echo (new Arr)->add(1)->append([2, 3, 4])->add(5)->get_sum();

class User
{
    public function set_name($name)
    {
        $this->name = $name;
        return $this;
    }

    public function set_surname($sur)
    {
        $this->surname = $sur;
        return $this;
    }

    public function set_patronymic($pat)
    {
        $this->patronymic = $pat;
        return $this;
    }

    public function get_full_name()
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }

    private $surname;
    private $name;
    private $patronymic;
}

echo (new User)->set_name('Николай')->set_patronymic('Иванович')->set_surname('Петров')->get_full_name(); // выведет 'ПНИ'