<?php
if( $book == "baking"){
    $stmt_session = $mysqli->prepare("INSERT INTO baking_bookings ($user_id,$name,$booking_date,$booking_time,$location,) VALUES (?)"); $stmt_session->bind_param("s", );
    $stmt_session->execute();
    $stmt_session->close();
}else{
    $stmt_session = $mysqli->prepare("INSERT INTO restraunt_bookings () VALUES (?)"); $stmt_session->bind_param("s", );
    $stmt_session->execute();
    $stmt_session->close();
}
