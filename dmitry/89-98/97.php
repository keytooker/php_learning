 <p> 
 	Урок 97. Наследование от класса и реализация интерфейса.
     Скопируйте код моего класса Employee и код интерфейса iProgrammer.
     Не копируйте мою заготовку класса iProgrammer - не подсматривая в мой код реализуйте этот класс самостоятельно.
 </p>
 <?php
 interface iProgrammer
 {
 	public function __construct($name, $salary); // задаем имя и зарплату
 	public function getName();
 	public function getSalary();
 	public function getLangs();
 	public function addLang($lang);
 }

 class Employee 
 {
 	public function __construct($name, $salary)
 	{
 		$this->name = $name;
 		$this->salary = $salary;
 	}

 	public function getName()
 	{
 		return $this->name;
 	}

 	public function getSalary()
 	{
 		return $this->salary;
 	}

 	private $name;
 	private $salary;
 }

 class Programmer extends Employee implements iProgrammer
 {
 	public function addLang($lang)
 	{
 		$this->langs[] = $lang;
 	}

 	public function getLangs()
 	{
 		return $this->langs;
 	}

 	private $langs = [];
 }

 $programmer = new Programmer('Mikhail', 2000);
 $programmer->addLang('PHP');
 $programmer->addLang('C++');
 $programmer->addLang('Pascal');

 echo $programmer->getName() . ' ' . $programmer->getSalary();
 $langs = $programmer->getLangs();
 ?>
 <p>
     <?php
 foreach ($langs as $lang) {

 	echo $lang . ' ';
 }

     ?>
 </p>