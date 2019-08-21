<pre>Урок 79 Передача по ссылке</pre>
<pre>Задача :

Сделайте класс Product (продукт), в котором будут следующие свойства: name (название продукта), price (цена).

Задача :

Создайте объект класса Product, запишите его в переменную $product1.

Задача :

Присвойте значение переменной $product1 в переменную $product2. Проверьте то, что обе переменные ссылаются на один и тот же объект.
</pre>
<?php

class Product
{
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public $name;
    public $price;
}

$prodict1 = new Product('Tomato', 80);
$prodict2 = $prodict1;

$prodict2->name = 'Coca-cola';
$prodict2->price = 120;

if ( ($prodict1->price === $prodict2->price) and ($prodict1->name === $prodict2->name) )
{
    echo 'обе переменные ссылаются на один и тот же объект';
}