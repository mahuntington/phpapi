<?php
    header('Content-Type: application/json');
    include __DIR__ . '/../data/people.php';

    if($_REQUEST['action'] === 'index'){
        echo json_encode($people);
    } else if ($_REQUEST['action'] === 'post'){
        $requestBody = file_get_contents('php://input');
        $body = json_decode($requestBody);
        $zagthar = new Person($body->name, $body->age);

        $people[] = $zagthar;

        echo json_encode($people);
    } else if ($_REQUEST['action'] === 'delete'){
        array_splice($people, $_REQUEST['id'], 1);
        echo json_encode($people);
    }
?>
