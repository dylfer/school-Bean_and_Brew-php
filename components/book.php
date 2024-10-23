<?php
include 'functions/uuid.php';
include 'components/DB_conect.php';
if( $book == "baking"){
    $stmt_session = $mysqli->prepare("INSERT INTO baking_bookings () VALUES (?)"); $stmt_session->bind_param("s", );
    $stmt_session->execute();
    $stmt_session->close();
}else{
    $stmt_session = $mysqli->prepare("INSERT INTO restraunt_bookings () VALUES (?)"); $stmt_session->bind_param("s", );
    $stmt_session->execute();
    $stmt_session->close();
}
