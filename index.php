<?php
    class Person {
        public $name;
        public $age;
    }

    $me = new Person();
    $me->name = 'Matt';
    $me->age = 37;

    echo json_encode($me);
?>
