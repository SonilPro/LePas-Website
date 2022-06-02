<?php
function recurseRmdir($dir)
{
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file") && !is_link("$dir/$file")) ? recurseRmdir("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir("$dir");
}
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
        }
    }
    return $result;
}
