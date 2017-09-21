<?
include_once __DIR__ . '/../database/db.php';

class Company {
    public $id;
    public $name;
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
}

class Companies {
    static function find(){
        $query = file_get_contents(__DIR__ . '/../database/sql/companies/find.sql');
        $result = pg_query($query);
        $companies = array();
        while($data = pg_fetch_object($result)){
            $companies[] = new Company(intval($data->id), $data->name);
        }

        return $companies;
    }
    static function create($company){
        $query = file_get_contents(__DIR__ . '/../database/sql/companies/create.sql');
        $result = pg_query_params($query, array($company->name));

        return self::find();
    }
    static function delete($id){
        $query = file_get_contents(__DIR__ . '/../database/sql/companies/delete.sql');
        $result = pg_query_params($query, array($id));

        return self::find();
    }
    static function update($id, $updatedCompany){
        $query = file_get_contents(__DIR__ . '/../database/sql/companies/update.sql');
        $result = pg_query_params($query, array($updatedCompany->name, $id));

        return self::find();
    }
}
?>
