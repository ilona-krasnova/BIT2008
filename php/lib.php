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
} // end exeSelect

// returns number of days until given date
function daysFromDate($dateStr)
{
    $date=strtotime($dateStr); // number of seconds from 1970
    $today=strtotime(date("Y-m-d"));
    $result = round(($today - $date) / (24 * 60 * 60)); // converted to days
    // daylight savings time is EVIL and forced me to round
    return ($result > 0) ? $result : 0;
} // end daysTillDate

// for shorter code
function getRequestParam($parameter)
{
    return isset($_REQUEST[$parameter]) ? $_REQUEST[$parameter] : NULL;
} // end getRequestParam

// TODO: returns ID of user that is logged in
function getCurrUserID()
{
    return 1;
}

?>