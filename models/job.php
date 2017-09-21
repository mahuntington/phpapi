<?
include_once __DIR__ . '/../database/db.php';

class Job {
    public $id;
    public $person_id;
    public $company_id;
    public function __construct($id, $person_id, $company_id) {
        $this->id = $id;
        $this->person_id = $person_id;
        $this->company_id = $company_id;
    }
}

class Jobs {
    static function find(){
        $query = file_get_contents(__DIR__ . '/../database/sql/jobs/find.sql');
        $result = pg_query($query);
        $jobs = array();
        while($data = pg_fetch_object($result)){
            $jobs[] = new Job(intval($data->id), intval($data->person_id), intval($data->company_id));
        }

        return $jobs;
    }
    static function create($job){
        $query = file_get_contents(__DIR__ . '/../database/sql/jobs/create.sql');
        $result = pg_query_params($query, array($job->person_id, $job->company_id));

        return self::find();
    }
}
?>
