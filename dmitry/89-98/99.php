<pre>
    Урок 99. Работа с трейтами.
</pre>
<p>
    Реализуйте класс Country (страна) со свойствами name (название), age (возраст), population (количество населения)
    и геттерами для них. Пусть наш класс для сокращения своего кода использует уже созданный нами трейт Helper.
</p>
<?php

trait Helper
{
    private $name;
    private $age;

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }
}

class Country
{
    use Helper;

    public function __construct($name, $age, $population)
    {
        $this->name = $name;
        $this->age = $age;
        $this->population = $population;
    }

    public function getPopulation()
    {
        return $this->population;
    }

    private $population;
}

$c = new Country('República de Honduras', 198, 8448465);
echo '<p>' . $c->getName() . '</p><p>Население: ' . $c->getPopulation() . '</p><p>Возраст: ' . $c->getAge() . '</p>';