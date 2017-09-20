<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../models/person.php';

if($_REQUEST['action'] === 'index'){
    echo json_encode(People::find());
} else if ($_REQUEST['action'] === 'post'){
    $requestBody = file_get_contents('php://input');
    $body = json_decode($requestBody);
    $newPerson = new Person(null, $body->name, $body->age);

    $allPeople = People::create($newPerson);

    echo json_encode($allPeople);
} else if ($_REQUEST['action'] === 'delete'){
    $allPeople = People::delete($_REQUEST['id']);
    echo json_encode($allPeople);
} else if ($_REQUEST['action'] === 'update'){
    $requestBody = file_get_contents('php://input');
    $body = json_decode($requestBody);
    $updatedPerson = new Person($body->name, $body->age);
    $allPeople = People::update($_REQUEST['id'], $updatedPerson);

    echo json_encode($allPeople);
}
?>
