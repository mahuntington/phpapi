<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../models/job.php';

if($_REQUEST['action'] === 'index'){
    echo json_encode(Jobs::find());
} else if ($_REQUEST['action'] === 'post'){
    $requestBody = file_get_contents('php://input');
    $body = json_decode($requestBody);

    $newJob = new Job(null, $body->person_id, $body->company_id);

    $allJobs = Jobs::create($newJob);

    echo json_encode($allJobs);
} else if ($_REQUEST['action'] === 'delete'){
    $allJobs = Jobs::delete($_REQUEST['id']);
    echo json_encode($allJobs);
} else if ($_REQUEST['action'] === 'update'){
    $requestBody = file_get_contents('php://input');
    $body = json_decode($requestBody);
    $updatedJob = new Job(null, $body->person_id, $body->company_id);
    $allJobs = Jobs::update($_REQUEST['id'], $updatedJob);

    echo json_encode($allJobs);
}
