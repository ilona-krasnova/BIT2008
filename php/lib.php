<?php
// universal function to execute select:
// returns an array with all result rows
function exeSelect($dblink, $sql)
{
    $res = array();

    $resQuery = mysqli_query($dblink, $sql);
    if (!$resQuery) 
    {
        echo "<p>" . mysqli_error($dblink) . "</p>";
    }
    
    while($rowData = mysqli_fetch_assoc($resQuery))
    {
        array_push($res, $rowData);
    }
    return $res;
}
?>