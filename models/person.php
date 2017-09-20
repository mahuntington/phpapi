<?
class Person {
    public $name;
    public $age;
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
}
class People {
    static function find(){
        $people = array();
        $people[] = new Person('joni', 52);
        $people[] = new Person('bob', 34);
        $people[] = new Person('sally', 21);
        $people[] = new Person('matt', 37);

        return $people;
    }
    static function add($person){
        $people = array();
        $people[] = new Person('joni', 52);
        $people[] = new Person('bob', 34);
        $people[] = new Person('sally', 21);
        $people[] = new Person('matt', 37);

        $people[] = $person;

        return $people;
    }
    static function delete($index){
        $people = array();
        $people[] = new Person('joni', 52);
        $people[] = new Person('bob', 34);
        $people[] = new Person('sally', 21);
        $people[] = new Person('matt', 37);

        array_splice($people, $index, 1);

        return $people;
    }
    static function update($index, $updatedPerson){
        $people = array();
        $people[] = new Person('joni', 52);
        $people[] = new Person('bob', 34);
        $people[] = new Person('sally', 21);
        $people[] = new Person('matt', 37);

        $people[$index] = $updatedPerson;
        return $people;
    }
}
?>
