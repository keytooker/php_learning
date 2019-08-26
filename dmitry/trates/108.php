<pre>
    Урок 108. Метод __get
</pre>
<p>
    Пусть дан вот такой класс User, свойства которого доступны только для чтения с помощью геттеров:

    class User
    {
        private $name;
        private $age;

        public function __construct($name, $age)
        {
            $this->name = $name;
            $this->age = $age;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getAge()
        {
            return $this->age;
        }
    }

    Переделайте код этого класса так, чтобы вместо геттеров использовался магический метод __get.
</p>
<?php
class User
{
    private $name;
    private $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function __get($arg)
    {
        return $this->$arg;
    }
}

$user = new User('Robinson', 29);
echo $user->name . ' ' . $user->age;
?>
<p>
    Сделайте класс Date с публичными свойствами year (год), month (месяц) и day (день).

    С помощью магии сделайте свойство weekDay, которое будет возвращать день недели, соответствующий дате.
</p>
<?php
class Date
{
    public $year;
    public $month;
    public $day;

    public function __get($p)
    {
        if ($p === 'weekDay')
        {
            $d = $this->year . '-' . $this->month . '-' . $this->day;
            $days = [
                'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
                'Четверг', 'Пятница', 'Суббота'
            ];
            $result = $days[ date('w', strtotime($d) )];
            return $result;
        }
    }
}

$d = new Date;
$d->year = 2020;
$d->month = 1;
$d->day = 1;

echo $d->weekDay;