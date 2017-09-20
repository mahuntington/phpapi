<?php
    header('Content-Type: application/json');
    include 'data/people.php';

    $requestBody = file_get_contents('php://input');
    $body = json_decode($requestBody);
    $zagthar = new Person($body->name, $body->age);

    $people[$_REQUEST['id']] = $zagthar;

    echo json_encode($people);
?>
