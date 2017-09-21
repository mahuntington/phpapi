<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../models/company.php';

if($_REQUEST['action'] === 'index'){
    echo json_encode(Companies::find());
} else if ($_REQUEST['action'] === 'post'){
    $requestBody = file_get_contents('php://input');
    $body = json_decode($requestBody);
    $newCompany = new Company(null, $body->name);

    $allCompanies = Companies::create($newCompany);

    echo json_encode($allCompanies);
} else if ($_REQUEST['action'] === 'delete'){
    $allCompanies = Companies::delete($_REQUEST['id']);
    echo json_encode($allCompanies);
} else if ($_REQUEST['action'] === 'update'){
    $requestBody = file_get_contents('php://input');
    $body = json_decode($requestBody);
    $updatedCompany = new Company(null, $body->name);
    $allCompanies = Companies::update($_REQUEST['id'], $updatedCompany);

    echo json_encode($allCompanies);
}
?>
