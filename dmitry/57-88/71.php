<?php

/*
 *  Пусть массив $methods будет ассоциативным с ключами method1 и method2:
<?php
	$methods = ['method1' => 'getName', 'method2' => 'getAge'];
?>

Выведите имя и возраст пользователя с помощью этого массива.
 */

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

$methods = ['method1' => 'getName', 'method2' => 'getAge'];
$user = new User('John', 28);

echo 'Возраст - ' . $user->{$methods['method2']}();
echo 'Имя - ' . $user->{$methods['method1']}();