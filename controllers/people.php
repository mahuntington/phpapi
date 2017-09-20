<?php
    header('Content-Type: application/json');
    include __DIR__ . '/../data/people.php';

    if($_REQUEST['action'] === 'index'){
        echo json_encode($people);
    }
?>
