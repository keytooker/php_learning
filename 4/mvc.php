<?php
class Model
{
    public $info;
    public function __construct(){
        $this->info = 'Simple Model';
    }
}

class View
{
    private $model;
    private $controller;
    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }
    public function output() {
        return '<p><a href="/php_learning/4/mvc.php?action=clicked">' . $this->model->info . '</a></p>';
    }
}

class Controller
{
    private $model;
    public function __construct($model){
        $this->model = $model;
    }
    public function clicked() {
        $this->model->info = 'Updated Model Info after click';
    }
}

echo 'test';
$model = new Model();
echo $model->info;

$controller = new Controller($model);
$view = new View($controller, $model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
    $controller->clicked();
}
echo $view->output();
?>