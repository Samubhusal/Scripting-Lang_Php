<?php
    class A{
        function __construct(){
            echo "Base class constructor<br>";
        }
    }
    class B extends A{
        private $id;
    }

    class student{
        private $name;
        private $rollnumber;

        public function __construct($n,$r){
            $this->name=$n;
            $this->rollnumber=$r;
        }

        public function displayInfo(){
            echo "Student Name:".$this ->name."<br>";
            echo "Roll Number:".$this->rollnumber."<br>";
        }
    }
    $obj=new B();

    $student1=new student("Samikshya Bhusal",30);
    $student1->displayInfo();
?>