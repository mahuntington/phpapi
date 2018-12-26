<?php
include_once __DIR__ . '/../database/db.php';
include_once __DIR__ . '/person.php';

class Location {
    public $id;
    public $street;
    public $city;
    public $state;
    public function __construct($id, $street, $city, $state) {
        $this->id = $id;
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
    }
}

class Locations {
    static function find(){
        $query = file_get_contents(__DIR__ . '/../database/sql/locations/find.sql');
        $result = pg_query($query);
        $locations = array();
        $current_location = null;
        while($data = pg_fetch_object($result)){
            if($current_location === null || $current_location->id !== intval($data->location_id)){
                $current_location = new Location(intval($data->location_id), $data->street, $data->city, $data->state);
                $current_location->residents = [];
                $locations[] = $current_location;
            }
            if($data->person_id){
                $new_person = new Person(intval($data->person_id), $data->name, intval($data->age));
                $current_location->residents[] = $new_person;
            }

        }

        return $locations;
    }
    static function create($location){
        $query = file_get_contents(__DIR__ . '/../database/sql/locations/create.sql');
        $result = pg_query_params($query, array($location->street, $location->city, $location->state));

        return self::find();
    }
    static function delete($id){
        $query = file_get_contents(__DIR__ . '/../database/sql/locations/delete.sql');
        $result = pg_query_params($query, array($id));

        return self::find();
    }
    static function update($id, $updatedLocation){
        $query = file_get_contents(__DIR__ . '/../database/sql/locations/update.sql');
        $result = pg_query_params($query, array($updatedLocation->street, $updatedLocation->city, $updatedLocation->state, $id));

        return self::find();
    }
}
?>
