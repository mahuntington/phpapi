<?
include_once __DIR__ . '/../database/db.php';

class Person {
    public $id;
    public $name;
    public $age;
    public function __construct($id, $name, $age) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
    }
}

class People {
    static function find(){
        $query = file_get_contents(__DIR__ . '/../database/sql/people/find.sql');
        $result = pg_query($query);
        $people = array();
        while($data = pg_fetch_object($result)){
            $people[] = new Person(intval($data->id), $data->name, intval($data->age));
        }

        return $people;
    }
    static function create($person){
        $query = file_get_contents(__DIR__ . '/../database/sql/people/create.sql');
        $result = pg_query_params($query, array($person->name, $person->age));

        return self::find();
    }
    static function delete($id){
        $query = file_get_contents(__DIR__ . '/../database/sql/people/delete.sql');
        $result = pg_query_params($query, array($id));

        return self::find();
    }
    static function update($id, $updatedPerson){
        $query = file_get_contents(__DIR__ . '/../database/sql/people/update.sql');
        $result = pg_query_params($query, array($updatedPerson->name, $updatedPerson->age, $id));

        return self::find();
    }
}
?>
