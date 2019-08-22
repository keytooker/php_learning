<pre>
    Урок 81. Передача объектов параметрами.
</pre>
<pre>
     Сделайте класс Product (товар), в котором будут приватные свойства name (название товара), price (цена за штуку)
    и quantity. Пусть все эти свойства будут доступны только для чтения.

    Добавьте в класс Product метод getCost, который будет находить полную стоимость продукта (сумма умножить на количество).
</pre>
<?php

class Product
{
    public function __construct($n, $p, $q)
    {
        $this->name = $n;
        $this->price = $p;
        $this->quantity = $q;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_price()
    {
        return $this->price;
    }

    public function get_quantity()
    {
        return $this->quantity;
    }

    public function get_cost()
    {
        return ($this->quantity * $this->price);
    }

    private $name;
    private $price;
    private $quantity;
}
?>

<pre>

Сделайте класс Cart (корзина). Данный класс будет хранить список продуктов (объектов класса Product) в виде массива.
    Пусть продукты хранятся в свойстве products.


Реализуйте в классе Cart метод add для добавления продуктов.

    Реализуйте в классе Cart метод remove для удаления продуктов. Метод должен принимать параметром название удаляемого
    продукта.


Реализуйте в классе Cart метод getTotalCost, который будет находить суммарную стоимость продуктов.
</pre>

<pre>

Реализуйте в классе Cart метод getTotalQuantity, который будет находить суммарное количество продуктов (то есть сумму
    свойств quantity всех продуктов).

Задача :

Реализуйте в классе Cart метод getAvgPrice, который будет находить среднюю стоимость продуктов (суммарная стоимость
    делить на количество всех продуктов).

</pre>

<?php
class Card
{
    public function add($product)
    {
        $this->products[] = $product;
    }

    public function remove($name)
    {
        unset($this->products[$name]);
    }

    public function get_total_cost()
    {
        $sum = 0;
        foreach ($this->products as $product)
        {
            $sum += $product->get_cost();
        }
        return $sum;
    }

    public function get_total_quantity()
    {
        $result = 0;
        foreach ($this->products as $product)
        {
            $result += $product->get_quantity();
        }
        return $result;
    }

    public function get_avg_price()
    {
        $result = $this->get_total_cost();
        $result = $result / $this->get_total_quantity();
        return $result;
    }

    private $products = [];
}

$tomato = new Product('tomato', 80, 2);
$cola = new Product('Cola', 60, 1);

$card = new Card();
$card->add($tomato);
$card->add($cola);
echo $card->get_total_quantity() . '|';
echo $card->get_total_cost() . '|';
echo $card->get_avg_price();
?>


