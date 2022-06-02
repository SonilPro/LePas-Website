<?php
define('_DEFVAR', 1);
require '../functions.php';
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "<script>
                alert('ZABRANJEN PRISTUP');
                window.location.href = 'index.php';
            </script>";
    die('Restricted Access');
}
if (isset($_POST['id'])) {
    //NEWS
    if (isset($_POST['title'])) {

        echo "SUCCESS";
        return;
    }
    //ANIMAL
    $result = "";
    $id = "";
    $name = "";
    $sex = "";
    $age = "";
    $type = "";
    $size = "";
    $arrivalDate = "";
    $description = "";
    $mainImage = "";
    $breed = "";
    $images = "";

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else return;
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    } else return;
    if (isset($_POST['sex'])) {
        $sex = $_POST['sex'];
    } else return;
    if (isset($_POST['age'])) {
        $age = $_POST['age'];
    } else return;
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    } else return;
    if (isset($_POST['size'])) {
        $size = $_POST['size'];
    } else return;
    if (isset($_POST['arrivalDate'])) {
        $arrivalDate = $_POST['arrivalDate'];
    } else return;
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    } else return;
    if (isset($_FILES['mainImage']['name'])) {
        $mainImage = $_FILES['mainImage']['name'];
    } else return;
    if (isset($_FILES['images']['name'])) {
        $images = $_FILES['images']['name'];
    } else return;
    if (isset($_POST['breed'])) {
        $breed = $_POST['breed'];
        if ($id == 'New') {
            include('../db/connection.php');
            if (!$conn) {
                $result = "Cannot connect to database";
            } else {
                $getQuery = "INSERT INTO animals(name, type_id, size_id, age, sex, arrivalDate, description, breed) 
                            VALUES('$name', '$type', $size, $age, '$sex', '$arrivalDate', '$description', '$breed')";
                if (mysqli_query($conn, $getQuery) === TRUE) {

                    $getQuery = "SELECT * FROM animals ORDER BY inputTimestamp DESC LIMIT 1";
                    $resultq = mysqli_query($conn, $getQuery);
                    $createdAnimalId = "";
                    while ($row = mysqli_fetch_assoc($resultq)) {
                        $createdAnimalId = $row['id'];
                    }
                    $imagesTargetDir = "../img/animals/" . $createdAnimalId;
                    $mainImgTargetDir = "$imagesTargetDir/mainImg/";
                    mkdir($imagesTargetDir);
                    mkdir($mainImgTargetDir);
                    if (move_uploaded_file($_FILES['mainImage']['tmp_name'], $mainImgTargetDir . 'main.' . pathinfo($mainImage, PATHINFO_EXTENSION))) {
                    } else {
                        $result = $mainImgTargetDir . basename($mainImage);
                    }
                    $getQuery = "UPDATE animals SET images = 'img/animals/$createdAnimalId/', mainImage = 'img/animals/$createdAnimalId/mainImg/'
                                    WHERE id = '$createdAnimalId'";
                    if (mysqli_query($conn, $getQuery)) {
                        $result = "Animal added successfully";
                    } else {
                        $result = "Problem with updating images";
                    }
                } else {
                    $result = "Error adding animal: " .  mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        } else {
        }

        echo $result;
    }
    die();
}
echo "No id";
