<?php
function getLayout($id)
{
    $result = "";
    switch ($id) {
        case 1:
            $result = "
                <h2>1</h2>
            ";
            break;
        case 2:
            $result = "
                    <h2>2</h2>
                ";
            break;
    }
    return $result;
}
