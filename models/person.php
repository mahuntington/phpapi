<?
include_once __DIR__ . '/../database/db.php';

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
        $query = file_get_contents(__DIR__ . '/../database/sql/find.sql');
        $result = pg_query($query);
        $people = array();
        while($data = pg_fetch_object($result)){
            $people[] = new Person($data->name, intval($data->age));
        }

        return $people;
    }
    static function create($person){
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
