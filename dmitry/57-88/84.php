<pre>Урок 84 Контроль типов</pre>
<pre> Сделайте класс Post (должность), в котором будут следующие свойства, доступные только для чтения:
    name (название должности) и salary (зарплата на этой должности).
</pre>
<?php
class Post
{
    public function __construct($name, $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function get_name()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function get_salary()
    {
        return $this->salary;
    }

    private $name;// (название должности)
    private $salary;
}
?>
<pre>

Создайте несколько объектов класса Post: программист, менеджер водитель.

</pre>
<?php
$programmer = new Post('Программист', 1500);
$manager = new Post('Медеджер', 2000);
$driver = new Post('Водитель', 1000);
?>
<pre>
Сделайте класс Employee (работник), в котором будут следующие свойства: name (имя) и surname (фамилия).
    Пусть начальные значения этих свойств будут передаваться параметром в конструктор.

    Сделайте геттеры и сеттеры для свойств name и surname.

    Пусть теперь третьим параметром конструктора будет передаваться должность работника, представляющая собой объект
    класса Post. Укажите тип этого параметра в явном виде.

    Сделайте так, чтобы должность работника (то есть переданный объект с должностью) записывалась в свойство post.

    Реализуйте в классе Employee метод changePost, который будет изменять должность работника на другую.
    Метод должен принимать параметром объект класса Post. Укажите в методе тип принимаемого параметра в явном виде.
</pre>
<?php
class Employee
{
    public function __construct($name, $surname, Post $post)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->post = $post;
    }

    public function change_post(Post $post)
    {
        if ($post instanceof Post)
            $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function get_surname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function get_name()
    {
        return $this->name;
    }

    /**
     * @return Post
     */
    public function get_post()
    {
        return $this->post;
    }

    private $name;
    private $surname;
    private $post;
}
?>
<pre>

Создайте объект класса Employee с должностью программист. При его создании используйте один из объектов класса Post, созданный нами ранее.
</pre>
<?php
$employee = new Employee('Иван',  'Иванов', $programmer);
?>
<pre>

Выведите на экран имя, фамилию, должность и зарплату созданного работника.


</pre>
<?php
echo $employee->get_surname() . ' ' . $employee->get_name() . ' ' . $employee->get_post()->get_salary();

$employee->change_post($manager);