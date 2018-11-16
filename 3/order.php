<?php
class Order
{
    public function calculateTotalSum(){/*...*/}
    public function getItems(){/*...*/}
    public function getItemCount(){/*...*/}
    public function addItem($item){/*...*/}
    public function deleteItem($item){/*...*/}
}

class OrderInfo
{
    public function printOrder(){/*...*/}
    public function showOrder(){/*...*/}

    private $order;
}

class OrderManager
{
    public function load(){/*...*/}
    public function save(){/*...*/}
    public function update(){/*...*/}
    public function delete(){/*...*/}

    private $order;
}