<?
include_once __DIR__ . '/../database/db.php';

class Job {
    public $id;
    public $job_type;
    public function __construct($id, $person_id, $job_type, $company_id) {
        $this->id = $id;
        if($person_id){
            $this->person_id = $person_id;
        }
        $this->job_type = $job_type;
        if($company_id){
            $this->company_id = $company_id;
        }
    }
}

class Jobs {
    static function find(){
        $query = file_get_contents(__DIR__ . '/../database/sql/jobs/find.sql');
        $result = pg_query($query);
        $jobs = array();
        while($data = pg_fetch_object($result)){
            $jobs[] = new Job(intval($data->id), intval($data->person_id), $data->job_type, intval($data->company_id));
        }

        return $jobs;
    }
    static function create($job){
        $query = file_get_contents(__DIR__ . '/../database/sql/jobs/create.sql');
        $result = pg_query_params($query, array($job->person_id, $job->job_type, $job->company_id));

        return self::find();
    }
    static function delete($id){
        $query = file_get_contents(__DIR__ . '/../database/sql/jobs/delete.sql');
        $result = pg_query_params($query, array($id));

        return self::find();
    }
    static function update($id, $updatedJob){
        $query = file_get_contents(__DIR__ . '/../database/sql/jobs/update.sql');
        $result = pg_query_params($query, array($updatedJob->person_id, $updatedJob->job_type, $updatedJob->company_id, $id));

        return self::find();
    }
}
?>
