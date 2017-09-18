<?php
    header('Content-Type: application/json');
    include 'data/people.php';

    array_splice($people, $_REQUEST['id'], 1);

    echo json_encode($people);
?>
