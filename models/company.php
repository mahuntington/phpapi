<?
include_once __DIR__ . '/../database/db.php';
include_once __DIR__ . '/job.php';
include_once __DIR__ . '/person.php';

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
        $current_company = null;
        while($data = pg_fetch_object($result)){
            if($current_company === null || $current_company->id !== intval($data->company_id)){
                $current_company = new Company(intval($data->company_id), $data->company_name);
                $current_company->employees = [];
                $companies[] = $current_company;
            }
            if($data->job_id){
                $new_person = new Person(intval($data->person_id), $data->person_name, intval($data->age));
                $new_job = new Job(intval($data->job_id), null, $data->job_type, null);
                $new_person->position = $new_job;
                $current_company->employees[] = $new_person;
            }
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
