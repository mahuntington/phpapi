<?php
    header('Content-Type: application/json');
    include 'data/people.php';

    echo json_encode($people);
?>
