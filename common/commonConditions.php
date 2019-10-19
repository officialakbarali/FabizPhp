<?php
$app_version = 1;
$forcePush_data = false;
$update_data = false;
$pause_sync = false;

function checkUserNamePassword($conn, $username, $password)
{
    $queryForUserCheck = "SELECT * FROM " . Staff::$TABLE_NAME . " WHERE BINARY " . Staff::$COLUMN_USER_NAME . " = '$username' AND " . Staff::$COLUMN_PASSWORD . " = '$password'";
    $userCheckresult = mysqli_query($conn, $queryForUserCheck);
    if (mysqli_num_rows($userCheckresult) > 0) {
        $returnArray = array();
        while ($row = mysqli_fetch_assoc($userCheckresult)) {
            $returnArray['precision'] = $row[Staff::$COLUMN_PRECISION];
            $returnArray['idOfStaff'] = $row[Staff::$ID];
        }
        return $returnArray;
    } else {
        return null;
    }
}

function updateFlag($conn, $userName)
{
    $updateFlagQuery = "UPDATE " . Staff::$TABLE_NAME . " 
    SET " . Staff::$COLUMN_FORCE . " = '0'," . Staff::$COLUMN_UPDATE . " = '0' 
    WHERE " . Staff::$COLUMN_USER_NAME . " = '$userName'";
    return mysqli_query($conn, $updateFlagQuery);
}
