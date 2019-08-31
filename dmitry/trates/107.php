<pre>
    Урок 107. __toString()
</pre>
<p>
    Сделайте класс User, в котором будут следующие свойства - name (имя), surname (фамилия), patronymic (отчество).

    Сделайте так, чтобы при выводе объекта через echo на экран выводилось ФИО пользователя (фамилия, имя, отчество через пробел).
</p>
<?php
class User
{
    public function __construct($name, $surname, $patronymic)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;
    }

    public function __toString()
    {
        $str = $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
        return $str;
    }

    private $name;
    private $surname;
    private $patronymic;
}

$user = new User('Иванов',  'Иван',  'Иванович');
echo $user;

class Arr
{
    public function add($item)
    {
        $this->arr[] = $item;
        return $this;
    }

    public function __toString()
    {
        return (string) array_sum($this->arr);
    }
    private $arr = [];
}

$a = new Arr;
echo $a->add(3)->add(20)->add(100);
