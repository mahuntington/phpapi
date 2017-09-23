<?
include_once __DIR__ . '/../database/db.php';

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
        while($data = pg_fetch_object($result)){
            $locations[] = new Location(intval($data->id), $data->street, $data->city, $data->state);
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
