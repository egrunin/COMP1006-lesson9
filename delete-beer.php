<?php ob_start();

// authenticate
require('auth.php'); ?>

<?php
// identity the record the user wants to delete
try {
$beer_id = null;
$beer_id = $_GET['beer_id'];

if (is_numeric($beer_id)) {
    // connect
    require('db.php'); 

    // prepare and execute the SQL DELETE command
    $sql = "DELETE FROM beers WHERE beer_id = :beer_id";

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':beer_id', $beer_id, PDO::PARAM_INT);
    $cmd->execute();

    // disconnect
    $conn = null;

    // redirect back to the updated beers.php
    header('location:beers.php');
}
}
catch (Exception $e) {
    header('location:error.php');
}

ob_flush(); ?>