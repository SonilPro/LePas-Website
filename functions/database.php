<?php
require 'functions.php';
function deleteObject($objectId, $layoutId)
{
    $result = "";
    include('db/connection.php');
    if (!$conn) {
        $result = "Cannot connect to database";
    } else {
        switch ($layoutId) {
            case 1:
                $getQuery = "DELETE FROM animals WHERE id=$objectId";
                if (mysqli_query($conn, $getQuery) === TRUE) {
                    $result = "Record deleted successfully";
                    $result = recurseRmdir("img/animals/$objectId");
                } else {
                    $result = "Error deleting record: " . $conn->error;
                }
                break;
            case 2:
                $getQuery = "DELETE FROM articles WHERE id=$objectId";
                if (mysqli_query($conn, $getQuery) === TRUE) {
                    $result = "Record deleted successfully";
                    $result = recurseRmdir("img/articles/$objectId");
                } else {
                    $result = "Error deleting record: " . $conn->error;
                }
                break;
        }
    }
    return $result;
}
