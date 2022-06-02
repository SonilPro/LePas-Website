<?php
if (!defined('_DEFVAR')) {
    echo "<script>
                alert('ZABRANJEN PRISTUP');
                window.location.href = 'index.php';
            </script>";
    die('Restricted Access');
}
function getLayout($id, $sort, $order, $page_number)
{
    $result = "";
    switch ($id) {
        case 1:
            $result = "
                    <table class='table'>
                        <thead>
                            <tr>
                            <th>#</th>
                                <th><a href='#' class='sort' column='mainImage' order='ASC'>Avatar<i class='fas fa-sort'></i></a></th>
                                <th><a href='#' class='sort' column='id' order='ASC'>ID<i class='fas fa-sort'></i></a></th>
                                <th><a href='#' class='sort' column='name' order='ASC'>Ime<i class='fas fa-sort'></i></a></th>
                                <th><a href='#' class='sort' column='age' order='ASC'>Starost<i class='fas fa-sort'></i></a></th>
                                <th><a href='#' class='sort' column='sex' order='ASC'>Spol<i class='fas fa-sort'></i></a></th>
                                <th><a href='#' class='sort' column='names' order='ASC'></a></th>
                            </tr>
                        </thead>
                        <tbody>";
            include('db/connection.php');
            if (!$conn) {
                $result = "Cannot connect to database";
            } else {
                $limit = 10;
                $getQuery = "SELECT * FROM animals";
                $queryResult = mysqli_query($conn, $getQuery);
                $total_rows = mysqli_num_rows($queryResult);
                $total_pages = ceil($total_rows / $limit);
                $initial_page = ($page_number - 1) * $limit;
                $resultq = mysqli_query($conn, "SELECT * FROM ( SELECT * FROM animals LIMIT $initial_page, $limit)AS a WHERE name LIKE '%%' ORDER BY $sort $order");

                for ($i = 0; $i <  mysqli_num_rows($resultq); $i++) {
                    $row = mysqli_fetch_assoc($resultq);
                    $files = array_diff(scandir($row['mainImage']), array('.', '..'));
                    $mainImage = "";
                    foreach ($files as $file) {
                        if (pathinfo($file, PATHINFO_FILENAME) == 'main') {
                            $mainImage .=  $row['mainImage'] . $file;
                        }
                    }
                    $result .= "
                    <tr>
                        <td>" . ($i + 1) . ".</td>
                        <td>
                            <div>
                                <a class='button2' href='#' nmbr=" . $row['id'] . "><img class='rounded-circle' src='" . $mainImage . "' alt=''></a>
                            </div>
                        </td>
                        <td> " . $row['id'] . "</td>
                        <td> <a class='button2' href='#' nmbr=" . $row['id'] . "><span class='name'>" . $row['name'] . "</span></a> </td>
                        <td> <span class='product'>" . $row['age'] . "</span> </td>
                        <td><span class='count'>" . $row['sex'] . "</span></td>
                        <td>
                        <a href='#' class='delete' id=" . $row['id'] . "><i class='fas fa-trash'></i></a>
                        </td>
                    </tr>
                    ";
                }
                $result .=
                    "</tbody>
                    </table>
                    <div style='text-align: center; display: block'>";
                for ($pn = 1; $pn <= $total_pages; $pn++) {
                    if ($pn == $page_number) {
                        $result .= "<a class='button1' style='color: #e4405f' page='$pn' nmbr='$id' href='#' >$pn</a>";
                    } else {
                        $result .= "<a class='button1' page='$pn' nmbr='$id' href='#' >$pn</a>";
                    }
                }
                $result .= "
                    </div>
                    <a class='button2' nmbr='new' href='#' style='text-align: center;'>Dodaj novu životinju</a>
                ";
                mysqli_close($conn);
            }
            break;
        case 2:
            $result = "
                    <h2>2</h2>
                ";
            break;
    }
    return $result;
}
function getObject($id, $layoutId)
{
    $result = "";
    switch ($layoutId) {
        case 1:
            if ($id == 'new') {
                include('db/connection.php');
                if (!$conn) {
                    $result = "Cannot connect to database";
                    return $result;
                }
                $queryResultSize = mysqli_query($conn, "SELECT * FROM animal_sizes");
                $queryResultType = mysqli_query($conn, "SELECT * FROM animal_types");
                $result = "
                        <form id='form' action='#' method='post'>

                        <h3>Obrazac za dodavanje životinje</h3>
                        <table cellspacing='30px'>
                            <tbody>
                                <tr>
                                    <td><label>Id:</label></td>
                                    <td><input style='border: none' value='New' type='text' name='id' disabled='disabled'/><br /></td>
                                </tr>
                                <tr>
                                    <td><label>Ime:</label></td>
                                    <td><input type='text' name='name' required maxlength='32' oninput=\"this.setCustomValidity('')\" oninvalid=\"this.setCustomValidity('Molimo upišite ime životinje')\" /><br /></td>
                                </tr>
                                <tr>
                                    <td><label>Životinja:</label></td>
                                    <td>
                                        <select name='type'>";
                while ($type = mysqli_fetch_assoc($queryResultType)) {
                    $result .= "<option value='$type[id]'>$type[type]</option>";
                }
                $todayDate = date('Y-m-d', strtotime('today'));
                $result .=  "</select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Spol:</label></td>
                                    <td>
                                        <select name='sex'>
                                            <option value='M'>M</option>
                                            <option value='Ž'>Ž</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Broj godina:</label></td>
                                    <td><input type='number' name='age' id='age' required /><br /></td>
                                </tr>
                                <tr>
                                    <td><label>Datum dolaska:</label></td>
                                    <td><input type='date' name='arrivalDate' id='arrivalDate' value='$todayDate' required oninput=\"this.setCustomValidity('')\" oninvalid=\"this.setCustomValidity('Molimo odaberite datum')\" /><br /></td>
                                </tr>
                                <tr>
                                    <td><label>Vrsta:</label></td>
                                    <td><input type='text' name='breed' id='breed' required /><br /></td>
                                </tr>
                                <tr>
                                    <td><label>Veličina:</label></td>
                                    <td>
                                        <select name='size'>";
                while ($size = mysqli_fetch_assoc($queryResultSize)) {
                    $result .= "<option value='$size[id]'>$size[size]</option>";
                }
                $result .=  "</select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Opis:</label></td>
                                    <td>
                                        <textarea name='description' cols='150' rows='20'></textarea>
                                    </td>
                                </tr>
                                <tr>
                                <td>
                                    <label>Glavna slika:</label></td>
                                <td>
                                    <div class='img'>
                                        <input type='file' id='file' name='mainImage' accept='image/*' enctype='multipart/form-data' required>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>
                                        <label>Slike:</label></td>
                                    <td>
                                        <div class='img'>
                                            <input type='file' id='file' name='images' accept='image/*' enctype='multipart/form-data' multiple required>
                                        </div>
                                    </td>
                                    </tr>
                                <tr>
                                <tr>
                                    <td></td>
                                    <td><input class='button' type='submit' name='submit' id='submit' value='Pošalji' /></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <div id='conf-msg'>
                        <h3>Forma je poslana!</h3>
                    </div>
                ";
                mysqli_close($conn);
                break;
            }
            include('db/connection.php');
            if (!$conn) {
                $result = "Cannot connect to database";
            } else {
                $queryResultSize = mysqli_query($conn, "SELECT * FROM animal_sizes");
                $queryResultType = mysqli_query($conn, "SELECT * FROM animal_types");
                $stmt = mysqli_prepare($conn, "SELECT * FROM animals WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $sqlResult = mysqli_stmt_get_result($stmt);

                while ($animal = mysqli_fetch_assoc($sqlResult)) {
                    $files = array_diff(scandir($animal['mainImage']), array('.', '..'));
                    $mainImage = "";
                    foreach ($files as $file) {
                        if (pathinfo($file, PATHINFO_FILENAME) == 'main') {
                            $mainImage .=  $animal['mainImage'] . $file;
                        }
                    }
                    $files = array_diff(scandir($animal['images']), array('.', '..'));
                    $result = "
                    <form id='form' action='#' method='post'>

                    <h3>Obrazac za ažuriranje</h3>
                    <table cellspacing='30px'>
                        <tbody>
                            <tr>
                                <td><label>Id:</label></td>
                                <td><input style='border: none'  value=" . $animal['id'] . " type='text' name='id' disabled='disabled'/><br /></td>
                            </tr>
                            <tr>
                                <td><label>Ime:</label></td>
                                <td><input  value=" . $animal['name'] . " type='text' name='firstname' required maxlength='32' oninput=\"this.setCustomValidity('')\" oninvalid=\"this.setCustomValidity('Molimo upišite vaše ime')\" /><br /></td>
                            </tr>
                            <tr>
                                <td><label>Životinja:</label></td>
                                <td>
                                    <select name='type'>";
                    while ($type = mysqli_fetch_assoc($queryResultType)) {
                        if ($animal['type_id'] == $type['id']) {
                            $result .= "<option value='$type[id]' selected='$type[type]'>$type[type]</option>";
                        } else {
                            $result .= "<option value='$type[id]'>$type[type]</option>";
                        }
                    }
                    $result .=  "</select>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Spol:</label></td>
                                <td>
                                    <select name='sex'>
                                        <option value='M' ";
                    $result .= ($animal['sex'] == 'M') ? "selected" : "";
                    $result .= ">M</option>
                                    <option value='Ž' ";
                    $result .= ($animal['sex'] == 'Ž') ? "selected" : "";
                    $result .= ">Ž</option>
                                </select>
                            </td>
                            </tr>
                            <tr>
                                <td><label>Datum dolaska:</label></td>
                                <td><input type='date' value='" . $animal['arrivalDate'] . "' name='arrivalDate' id='arrivalDate' oninput=\"this.setCustomValidity('')\" oninvalid=\"this.setCustomValidity('Molimo odaberite datum')\" /><br /></td>
                            </tr>
                            <tr>
                                <td><label>Vrsta:</label></td>
                                <td><input type='text' name='breed' id='breed' required /><br /></td>
                            </tr>
                            <tr>
                                    <td><label>Veličina:</label></td>
                                    <td>
                                        <select name='size'>";
                    while ($size = mysqli_fetch_assoc($queryResultSize)) {
                        if ($animal['size_id'] == $size['id']) {
                            $result .= "<option value='$size[id]' selected='$size[size]'>$size[size]</option>";
                        } else {
                            $result .= "<option value='$size[id]'>$size[size]</option>";
                        }
                    }
                    $result .=  "</select>
                                    </td>
                            </tr>
                            <tr>
                                <td><label>Opis:</label></td>
                                <td>
                                    <textarea name='description' cols='150' rows='20'>" . $animal['description'] . "</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Glavna slika:</label></td>
                                <td>
                                    <div class='img'>
                                        <img src='$mainImage' alt='mainImage'>
                                        <input type='file' id='mainImage' name='mainImage' accept='image/*' enctype='multipart/form-data'>
                                    </div>
                                </td>
                                </tr>
                            <tr>
                            <tr>
                                <td>
                                    <label>Slike:</label></td>
                                <td>
                                    <div class='img'>";
                    foreach ($files as $file) {
                        if (pathinfo($file, PATHINFO_EXTENSION)) {
                            $result .= "<img src='" . $animal['images'] . $file . "' alt='mainImage'>";
                        }
                    }
                    // <img src='$mainImage' alt='mainImage'>
                    $result .= "
                                        <input type='file' id='images' name='images' accept='image/*' enctype='multipart/form-data' multiple>
                                    </div>
                                </td>
                                </tr>
                            <tr>
                                <td></td>
                                <td><input class='button' type='submit' name='submit' id='submit' value='Pošalji' /></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <div id='conf-msg'>
                    <h3>Forma je poslana!</h3>
                </div>
                    ";
                }
                mysqli_close($conn);
            }
            break;
        case 2:
            $result = "News";
            break;
        default:
            $result = "No object of that type";
    }
    return $result;
}
