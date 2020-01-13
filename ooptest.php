<?php

// errors if didn't use public, errors if didn't use $this

// extends - allows another class to extend and inherit from class
// parent:: allows extended class to use other class's functionality

// public accessible anywhere, 
// private only within the class that defines it,
// protected only within the class or descendant classes

// setters and getters - to get or set objects in from protected variables
// in class tree

// __construct, __destruct or other magic methods - __construct runs
// when new object is instantiated, __destruct when it's unset - 
// there are others - remember to use 2 __ before construct or destruct

// static allows it to be accessed without instantiation of a class
// self:: or static:: is to be used for static methods or attributes
// self:: occurs at class level, static is bound to class it's called in

// if you set the value of a static variable from anywhere, it's going
// to be shared among the whole program

class Person{

	public $name = 'Jim';
	public $age = 29;
	
	public function say_hi(){
		echo "Hello, my name is " . $this->name . ".  I am " . $this->age . " years old.";
	}
}

// getter and setter example

$person = new Person();
$person->say_hi();
echo "<br>";
echo $person->name;
echo $person->age;

class SetterGetterExample{
	// can't access this globally
	private $a=1;

	public function get_a(){
		return $this->a;
	}

	public function set_a($value){
		$this->a = $value;
	}
}

$example = new SetterGetterExample();
// restricted: echo $example->a . "<br />";

echo "<br/>";
echo "get value: " . $example->get_a() . "<br />";
$example->set_a(15);
echo "set value: " . $example->get_a() . "<br />";

// using self and static

class Student{
	static $total_students=0;
	
	static public function add_students(){
		self::$total_students++;
	}
	
	static function welcome_students($var="Hello"){
		echo "{$var} students.";
	}
}

echo Student::$total_students . "<br/>";
echo Student::welcome_students() . "<br/>";
echo Student::welcome_students("Greetings") . "<br/>";
Student::$total_students = 1;
echo Student::$total_students . "<br/>";

Student::add_students();
echo Student::$total_students . "<br/>";

?>