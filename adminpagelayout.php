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
                            <th>Serial</th>
                                <th><a href='#' class='sort' column='mainImage' order='ASC'>Avatar<i class='fas fa-sort'></i></a></th>
                                <th><a href='#' class='sort' column='id' order='ASC'>ID<i class='fas fa-sort'></i></a></th>
                                <th><a href='#' class='sort' column='name' order='ASC'>Ime<i class='fas fa-sort'></i></a></th>
                                <th><a href='#' class='sort' column='age' order='ASC'>Starost<i class='fas fa-sort'></i></a></th>
                                <th><a href='#' class='sort' column='sex' order='ASC'>Spol<i class='fas fa-sort'></i></a></th>
                                <th><a href='#' class='sort' column='names' order='ASC'>Status<i class='fas fa-sort'></i></a></th>
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
                $resultq = mysqli_query($conn, "SELECT * FROM ( SELECT * FROM animals LIMIT $initial_page, $limit)AS a ORDER BY $sort $order");
                for ($i = 0; $i < mysqli_num_rows($resultq); $i++) {
                    $row = mysqli_fetch_assoc($resultq);
                    $result .= "
                    <tr>
                        <td>" . ($i + 1) . ".</td>
                        <td>
                            <div>
                                <a class='button2' href='#form' nmbr=" . $row['id'] . "><img class='rounded-circle' src='" . $row['mainImage'] . "' alt=''></a>
                            </div>
                        </td>
                        <td> " . $row['id'] . "</td>
                        <td> <span class='name'>" . $row['name'] . "</span> </td>
                        <td> <span class='product'>" . $row['age'] . "</span> </td>
                        <td><span class='count'>" . $row['sex'] . "</span></td>
                        <td>
                        <span class='badge badge-complete'>Complete</span>
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
                    <a class='button2' nmbr='new' href='#form' style='text-align: center;'>Dodaj novu životinju</a>
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
                                    <td><input type='text' name='firstname' required maxlength='32' oninput='this.setCustomValidity('')' oninvalid='this.setCustomValidity('Molimo upišite vaše ime')' /><br /></td>
                                </tr>
                                <tr>
                                    <td><label>Prezime:</label></td>
                                    <td><input type='text' name='lastname' required maxlength='32' oninput='this.setCustomValidity('')' oninvalid='this.setCustomValidity('Molimo upišite vaše prezime')' /><br /></td>
                                </tr>
                                <tr>
                                    <td><label>E-mail:</label></td>
                                    <td><input type='email' name='mail' id='mail' oninput='this.setCustomValidity('')' oninvalid='this.setCustomValidity('Email je krivo upisan')' /><br /></td>
                                </tr>
                                <tr>
                                    <td><label>Telefon:</label></td>
                                    <td><input type='tel' name='phone' id='phone' required /><br /></td>
                                </tr>
                                <tr>
                                    <td><label>Poruka:</label></td>
                                    <td>
                                        <textarea cols='30' rows='10'></textarea>
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
                break;
            }
            include('db/connection.php');
            if (!$conn) {
                $result = "Cannot connect to database";
            } else {
                $stmt = mysqli_prepare($conn, "SELECT * FROM animals WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($animal = mysqli_fetch_assoc($result)) {
                    $result = "
                    <form id='form' action='#' method='post'>

                    <h3>Obrazac za dodavanje životinje</h3>
                    <table cellspacing='30px'>
                        <tbody>
                            <tr>
                                <td><label>Id:</label></td>
                                <td><input style='border: none'  value=" . $animal['id'] . " type='text' name='id' disabled='disabled'/><br /></td>
                            </tr>
                            <tr>
                                <td><label>Ime:</label></td>
                                <td><input  value=" . $animal['name'] . " type='text' name='firstname' required maxlength='32' oninput='this.setCustomValidity('')' oninvalid='this.setCustomValidity('Molimo upišite vaše ime')' /><br /></td>
                            </tr>
                            <tr>
                                <td><label>Prezime:</label></td>
                                <td><input type='text' name='lastname' required maxlength='32' oninput='this.setCustomValidity('')' oninvalid='this.setCustomValidity('Molimo upišite vaše prezime')' /><br /></td>
                            </tr>
                            <tr>
                                <td><label>E-mail:</label></td>
                                <td><input type='email' name='mail' id='mail' oninput='this.setCustomValidity('')' oninvalid='this.setCustomValidity('Email je krivo upisan')' /><br /></td>
                            </tr>
                            <tr>
                                <td><label>Telefon:</label></td>
                                <td><input type='tel' name='phone' id='phone' required /><br /></td>
                            </tr>
                            <tr>
                                <td><label>Poruka:</label></td>
                                <td>
                                    <textarea cols='30' rows='10'></textarea>
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
