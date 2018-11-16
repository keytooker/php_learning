<?php


interface Product
{}


class Tea implements Product
{
}

class Coffee implements Product
{
}


class Factory
{
    public function create($type)
    {
        switch ($type) {
            case 'coffee':
                return new Coffee();
            case 'tea':
                return new Tea();
        }
    }
}

$factory = new Factory();
$productA = $factory->create('tea');