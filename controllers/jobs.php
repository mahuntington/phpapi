<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../models/job.php';

if ($_REQUEST['action'] === 'post'){
    $requestBody = file_get_contents('php://input');
    $body = json_decode($requestBody);

    $newJob = new Job(null, $body->person_id, $body->company_id);

    $allJobs = Jobs::create($newJob);

    echo json_encode($allJobs);
}
