<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../models/location.php';

if($_REQUEST['action'] === 'index'){
    echo json_encode(Locations::find());
} else if ($_REQUEST['action'] === 'post'){
    $requestBody = file_get_contents('php://input');
    $body = json_decode($requestBody);

    $newLocation = new Location(null, $body->street, $body->city, $body->state);

    $allLocations = Locations::create($newLocation);

    echo json_encode($allLocations);
} else if ($_REQUEST['action'] === 'delete'){
    $allLocations = Locations::delete($_REQUEST['id']);
    echo json_encode($allLocations);
} else if ($_REQUEST['action'] === 'update'){
    $requestBody = file_get_contents('php://input');
    $body = json_decode($requestBody);
    $updatedLocation = new Location(null, $body->street, $body->city, $body->state);
    $allLocations = Locations::update($_REQUEST['id'], $updatedLocation);

    echo json_encode($allLocations);
}
