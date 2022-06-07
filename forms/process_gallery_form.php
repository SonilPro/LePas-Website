<?php
define('_DEFVAR', 1);
include('../db/connection.php');
$returnResult = "";

$sex = "";
$size = "";

if (isset($_POST['sex'])) {
    $sex = $_POST['sex'];
}
if (isset($_POST['size'])) {
    $size = $_POST['size'];
}

if (!$conn) {
    echo "<script language='javascript'>";
    echo "console.log(\"" . mysqli_connect_error() . "\");";
    echo "</script>";
} else {
    $result = mysqli_query($conn, "SELECT * FROM animals WHERE sex LIKE '%$sex%' AND size_id LIKE '%$size%' ORDER BY inputTimestamp DESC");
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $row = mysqli_fetch_assoc($result);
        $files = array_diff(scandir("../" . $row['mainImage']), array('.', '..'));
        $mainImage = "";
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_FILENAME) == 'main') {
                $mainImage .=  $row['mainImage'] . $file;
            }
        }
        $returnResult .= "
            <div class='card' style='background-image: url(" .  $mainImage . ")'>
              <a href='animalpage.php?id=" . $row["id"] . "'>
                <div class='description'>
                  <h3>" . $row["name"] . "</h3>
                </div>
              </a>
            </div>
            ";
    }
    mysqli_close($conn);
    echo $returnResult;
}
