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
    }
    if (isset($_POST['sex'])) {
        $sex = $_POST['sex'];
    }
    if (isset($_POST['age'])) {
        $age = $_POST['age'];
    }
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    }
    if (isset($_POST['size'])) {
        $size = $_POST['size'];
    }
    if (isset($_POST['arrivalDate'])) {
        $arrivalDate = $_POST['arrivalDate'];
    }
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    }
    if (isset($_FILES['mainImage']['name'])) {
        $mainImage = $_FILES['mainImage']['name'];
    }
    if (isset($_FILES['images']['name'])) {
        $images = $_FILES['images']['name'];
    }
    if (isset($_POST['title'])) {
        $title = $_POST['title'];
    }
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
    }
    if (isset($_POST['breed'])) {
        $breed = $_POST['breed'];
        if ($id == 'New') {
            include('../db/connection.php');
            if (!$conn) {
                $result = "Cannot connect to database";
            } else {
                $getQuery = "INSERT INTO animals(name, type_id, size_id, age, sex, arrivalDate, description, breed) 
                            VALUES('$name', $type, $size, $age, '$sex', '$arrivalDate', '$description', '$breed')";
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

                    $countfiles = count($_FILES['images']['name']);
                    for ($i = 0; $i < $countfiles; $i++) {
                        $fileExt = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                        if (!move_uploaded_file($_FILES['images']['tmp_name'][$i], $imagesTargetDir . '/' . $i . '.' . $fileExt)) {
                            $result = $fileExt . $countfiles;
                        }
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
            include('../db/connection.php');
            if (!$conn) {
                $result = "Cannot connect to database";
            } else {
                $getQuery = "UPDATE animals
                            SET name = '$name',
                            type_id = $type,
                            size_id = $size,
                            age = $age,
                            sex = '$sex',
                            arrivalDate = '$arrivalDate',
                            description = '$description',
                            breed = '$breed'
                            WHERE id = $id";
                if (mysqli_query($conn, $getQuery) === TRUE) {

                    $imagesTargetDir = "../img/animals/" . $id;
                    $mainImgTargetDir = "$imagesTargetDir/mainImg/";
                    mkdir($imagesTargetDir);
                    mkdir($mainImgTargetDir);


                    $countfiles = count($_FILES['mainImage']['name']);
                    if ($countfiles > 0 && pathinfo($mainImage, PATHINFO_EXTENSION) != null) {
                        $dirHandle = opendir($mainImgTargetDir);
                        while ($file = readdir($dirHandle)) {
                            unlink($mainImgTargetDir . $file);
                        }
                        closedir($dirHandle);
                    }
                    if (move_uploaded_file($_FILES['mainImage']['tmp_name'], $mainImgTargetDir . 'main.' . pathinfo($mainImage, PATHINFO_EXTENSION))) {
                    } else {
                        $result = "Image cannot be updated";
                    }

                    $countfiles = count(array_filter($_FILES['images']['name']));
                    if ($countfiles > 0) {
                        $dirHandle = opendir($imagesTargetDir);
                        while ($file = readdir($dirHandle)) {
                            unlink($imagesTargetDir . "/" . $file);
                        }
                        closedir($dirHandle);
                    }

                    for ($i = 0; $i < $countfiles; $i++) {
                        $fileExt = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                        if (!move_uploaded_file($_FILES['images']['tmp_name'][$i], $imagesTargetDir . '/' . $i . '.' . $fileExt)) {
                            $result = "$fileExt . $countfiles";
                        }
                    }

                    $result = "Animal updated successfully";
                } else {
                    $result = "Error adding animal: " .  mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        }

        echo $result;
    } else { //ARTICLE
        if ($id == 'New') {
            include('../db/connection.php');
            if (!$conn) {
                $result = "Cannot connect to database";
            } else {
                $date = date("Y-m-d H:i:s");
                $getQuery = "INSERT INTO articles(title, content, description, lastEdit) 
                            VALUES('$title', '$content', '$description', '$date')";
                if (mysqli_query($conn, $getQuery) === TRUE) {

                    $getQuery = "SELECT * FROM articles ORDER BY inputTimestamp DESC LIMIT 1";
                    $resultq = mysqli_query($conn, $getQuery);
                    $createdNewsId = "";
                    while ($row = mysqli_fetch_assoc($resultq)) {
                        $createdNewsId = $row['id'];
                    }
                    $mainImgTargetDir = "../img/articles/" . $createdNewsId;
                    mkdir($mainImgTargetDir);
                    if (move_uploaded_file($_FILES['mainImage']['tmp_name'], $mainImgTargetDir . '/main.' . pathinfo($mainImage, PATHINFO_EXTENSION))) {
                    } else {
                        $result = $mainImgTargetDir . basename($mainImage);
                    }

                    $getQuery = "UPDATE articles SET image = 'img/articles/$createdNewsId/'
                                    WHERE id = '$createdNewsId'";
                    if (mysqli_query($conn, $getQuery)) {
                        $result = "Article added successfully";
                    } else {
                        $result = "Problem with updating image";
                    }
                } else {
                    $result = "Error adding article: " .  mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        } else {
            include('../db/connection.php');
            if (!$conn) {
                $result = "Cannot connect to database";
            } else {
                $getQuery = "UPDATE articles
                            SET title = '$title',
                            content = '$content',
                            description = '$description',
                            lastEdit = '" . date("Y-m-d H:i:s") . "'
                            WHERE id = $id";
                if (mysqli_query($conn, $getQuery) === TRUE) {

                    $mainImgTargetDir = "../img/articles/" . $id . "/";
                    mkdir($mainImgTargetDir);


                    $countfiles = count($_FILES['mainImage']['name']);
                    if ($countfiles > 0 && pathinfo($mainImage, PATHINFO_EXTENSION) != null) {
                        $dirHandle = opendir($mainImgTargetDir);
                        while ($file = readdir($dirHandle)) {
                            unlink($mainImgTargetDir . $file);
                        }
                        closedir($dirHandle);
                    }
                    if (move_uploaded_file($_FILES['mainImage']['tmp_name'], $mainImgTargetDir . 'main.' . pathinfo($mainImage, PATHINFO_EXTENSION))) {
                        $result = "Article updated successfully";
                    } else {
                        $result = "Image cannot be updated";
                    }
                } else {
                    $result = "Error updating article: " .  mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        }
        echo $result;
    }
    die();
}
echo "No id";
