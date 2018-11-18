<?php


interface Subject
{
    public function addObserver($observer);

    public function removeObserver($observer);

    public function notifyObserver();
}

class WeatherData implements Subject
{
    protected $observers;
    protected $temp;
    protected $humidity;
    protected $pressure;

    public function __construct()
    {
        $this->observers = [];
    }

    public function addObserver($observer)
    {
        $this->observers[] = $observer;
    }

    public function removeObserver($observer)
    {
        if (($key = array_search($observer, $this->observers)) !== FALSE) {

            unset($this->observers[$key]);
        }
    }

    public function notifyObserver()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->temp, $this->humidity, $this->pressure);
        }
    }

    public function setWeather($temp, $humidity, $pressure)
    {
        $this->temp = $temp;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->notifyObserver();
    }

}

interface Observer
{
    public function update($temp, $humidity, $pressure);

    public function display();
}

class AvgDisplay implements Observer
{
    protected $temp;
    protected $humidity;
    protected $pressure;

    public function update($temp, $humidity, $pressure)
    {
        $this->temp = $temp;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->display();
    }

    public function display()
    {
        $avg = ($this->temp + $this->humidity + $this->pressure) / 3;
        echo 'Среднее значения: ' . $avg;
    }
}

class CurrentData implements Observer
{
    protected $temp;
    protected $humidity;
    protected $pressure;

    public function update($temp, $humidity, $pressure)
    {
        $this->temp = $temp;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->display();
    }

    public function display()
    {
        echo 'Температура: ' . $this->temp;
        echo '; Влажность:' . $this->temp;
        echo '; Давление:' . $this->pressure;
    }
}


$weatherData = new WeatherData();
$weatherData->addObserver(new CurrentData());
$weatherData->addObserver(new AvgDisplay());
$weatherData->setWeather(22, 65, 80);
