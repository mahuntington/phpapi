<?
include_once __DIR__ . '/../database/db.php';
include_once __DIR__ . '/job.php';
include_once __DIR__ . '/company.php';
include_once __DIR__ . '/location.php';

class Person {
    public $id;
    public $name;
    public $age;
    public function __construct($id, $name, $age, $location_id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        if($location_id){
            $this->location_id = $location_id;
        }
    }
}

class People {
    static function find(){
        $query = file_get_contents(__DIR__ . '/../database/sql/people/find.sql');
        $result = pg_query($query);
        $people = array();
        $current_person = null;
        while($data = pg_fetch_object($result)){
            if($current_person === null || $current_person->id !== intval($data->person_id)){
                $current_person = new Person(intval($data->person_id), $data->person_name, intval($data->age));
                $current_person->jobs = [];
                $people[] = $current_person;
            }
            if($data->job_id){
                $new_job = new Job(intval($data->job_id), null, $data->job_type, null);
                $new_job->company = new Company(intval($data->company_id), $data->company_name);
                $current_person->jobs[] = $new_job;
            }
            if($data->location_id){
                $new_location = new Location(intval($data->location_id), $data->street, $data->city, $data->state);
                $current_person->location = $new_location;
            }
        }

        return $people;
    }
    static function create($person){
        $query = file_get_contents(__DIR__ . '/../database/sql/people/create.sql');
        $result = pg_query_params($query, array($person->name, $person->age, $person->location_id));

        return self::find();
    }
    static function delete($id){
        $query = file_get_contents(__DIR__ . '/../database/sql/people/delete.sql');
        $result = pg_query_params($query, array($id));

        return self::find();
    }
    static function update($id, $updatedPerson){
        $query = file_get_contents(__DIR__ . '/../database/sql/people/update.sql');
        $result = pg_query_params($query, array($updatedPerson->name, $updatedPerson->age, $updatedPerson->location_id, $id));

        return self::find();
    }
}
?>
