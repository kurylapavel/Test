<?php

    class First {
        public $name; 
        function __construct($name){
            $this->name = $name;
        }

        function getClassname(){
            echo $this->name,'<br/>';
        }

        function getLetter(){
            echo 'A <br/>';
        }
    }

    class Second extends first {
        function getLetter(){
            echo 'B <br/>';
        }
    }


    $first = new First("First");
    $first->getClassname(); 

    $second = new Second("Second");
    $second->getClassname();

    $first->getLetter();
    $second->getLetter();

?>