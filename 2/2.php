<?php
/**
 * Задача 1.
 *
 * Сделайте 3 трейта с названиями Trait1, Trait2 и Trait3. Пусть в первом трейте будет метод method1, возвращающий 1,
 * во втором трейте - метод method2, возвращающий 2, а в третьем трейте - метод method3, возвращающий 3.
 * Пусть все эти методы будут приватными.
 *
 *
 * Задача 2
 *
 * Сделайте класс Test, использующий все три созданных нами трейта.
 * Сделайте в этом классе публичный метод getSum, возвращающий сумму результатов методов подключенных трейтов.
 *
 *
 * Задача 3.
 * Использовать трейт в трейте, например в Trait 1 использовать Trait 2, здесь по вашему усмотрению
 *
 * 3адача 4:
 * Паттерные проектирования (синглетон)
 * Применить Singleton на примере создания соединения к базе данных MySQL. (любая арзитектора, нужно лишь понимание использования синглетона)
 */

trait Trait1
{
    private function method1()
    {
        return 1;
    }
}

trait Trait2
{
    use Trait1; // Использовать трейт в трейте

    private function method2()
    {
        return 2;
    }

    public function sum(): int
    {
        return $this->method2() + $this->method1();
    }
}

trait Trait3
{
    private function method3()
    {
        return 3;
    }
}

class Test
{
    use Trait1;
    use Trait2 {
        Trait1::method1 insteadof Trait2;
    }

    use Trait3;

    public function getSum(): int
    {
        return $this->method1() + $this->method2() + $this->method3();
    }
}

//$test = new Test();
//echo $test->getSum(), PHP_EOL;
//echo $test->sum();

const DB_NAME = 'php_test';
const DB_USER = 'root';
const DB_HOST = '127.0.0.1';
const DB_PASS = '';

class DbSingleton
{
    private static $db = null;

    private function __construct ()
    {
        $this->db = new PDO
        (
            'mysql:host=' . DB_HOST . ';
            dbname=' . DB_NAME,
            DB_USER,
            DB_PASS
        );

    }

    public static function instance()
    {
        if (null === self::$db)
        {
            self::$db = new self();
        }
        return self::$db;
    }
}

$db = DbSingleton::instance();
$db2 = DbSingleton::instance();

//var_dump($db === $db2); // bool(true)