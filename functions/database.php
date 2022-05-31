<?php

function deleteObject($objectId, $layoutId)
{
    $result = "";
    include('db/connection.php');
    if (!$conn) {
        $result = "Cannot connect to database";
    } else {
        switch ($layoutId) {
            case 1:
                $getQuery = "select * FROM animals WHERE id=$objectId";
                if (mysqli_query($conn, $getQuery) === TRUE) {
                    $result = "Record deleted successfully";
                } else {
                    $result = "Error deleting record: " . $conn->error;
                }
                break;
        }
    }

    return $result;
}
