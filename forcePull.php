<?php
include 'common/common.php';

$userName = $_POST['my_username'];
$password = $_POST['my_password'];
$version = $_POST['app_version'];
if ($version != $app_version) {
    $response["status"] = "VERSION";
} else {
    $resultOfAuth = checkUserNamePassword($conn, $userName, $password);
    if ($resultOfAuth != null) {
        if ($pause_sync) {
            $response["status"] = "PAUSE";
        } else {
//***************************************started*****************************************************/
            $response["success"] = true;
            $response[Item::$TABLE_NAME . "status"] = true;
            $response[Customer::$TABLE_NAME . "status"] = true;
            $response[BillDetail::$TABLE_NAME . "status"] = true;
            $response[Cart::$TABLE_NAME . "status"] = true;
            $response[SalesReturn::$TABLE_NAME . "status"] = true;
            $response[Payment::$TABLE_NAME . "status"] = true;

//ITEM
            $itemQuery = "SELECT * FROM " . Item::$TABLE_NAME;
            $itemQueryResult = mysqli_query($conn, $itemQuery);
            if (mysqli_num_rows($itemQueryResult) > 0) {
                $cursorArray = array();
                $temp = array();
                while ($row = mysqli_fetch_assoc($itemQueryResult)) {
                    $temp[Item::$ID] = $row[Item::$ID];
                    $temp[Item::$COLUMN_BARCODE] = $row[Item::$COLUMN_BARCODE];
                    $temp[Item::$COLUMN_NAME] = $row[Item::$COLUMN_NAME];
                    $temp[Item::$COLUMN_BRAND] = $row[Item::$COLUMN_BRAND];
                    $temp[Item::$COLUMN_CATEGORY] = $row[Item::$COLUMN_CATEGORY];
                    $temp[Item::$COLUMN_PRICE] = $row[Item::$COLUMN_PRICE];
                    array_push($cursorArray, $temp);
                }
                $response[Item::$TABLE_NAME] = $cursorArray;
            } else {
                $response["success"] = false;
                $response["status"] = "ITEM";
                $response[Item::$TABLE_NAME . "status"] = false;
            }

//CUSTOMER QUERY
            $customerQuery = "SELECT * FROM " . Customer::$TABLE_NAME . " WHERE " . Customer::$STAFF_ID . " = '1'";
            $customerQueryResult = mysqli_query($conn, $customerQuery);
            if (mysqli_num_rows($customerQueryResult) > 0) {
                $cursorArray = array();
                $temp = array();
                while ($row = mysqli_fetch_assoc($customerQueryResult)) {
                    $temp[Customer::$ID] = $row[Customer::$ID];
                    $temp[Customer::$COLUMN_BARCODE] = $row[Customer::$COLUMN_BARCODE];
                    $temp[Customer::$COLUMN_CR_NO] = $row[Customer::$COLUMN_CR_NO];
                    $temp[Customer::$COLUMN_SHOP_NAME] = $row[Customer::$COLUMN_SHOP_NAME];
                    $temp[Customer::$COLUMN_NAME] = $row[Customer::$COLUMN_NAME];
                    $temp[Customer::$COLUMN_DAY] = $row[Customer::$COLUMN_DAY];
                    $temp[Customer::$COLUMN_PHONE] = $row[Customer::$COLUMN_PHONE];
                    $temp[Customer::$COLUMN_EMAIL] = $row[Customer::$COLUMN_EMAIL];
                    $temp[Customer::$COLUMN_ADDRESS] = $row[Customer::$COLUMN_ADDRESS];
                    $temp[Customer::$COLUMN_TELEPHONE] = $row[Customer::$COLUMN_TELEPHONE];
                    $temp[Customer::$COLUMN_VAT_NO] = $row[Customer::$COLUMN_VAT_NO];
                    array_push($cursorArray, $temp);
                }
                $response[Customer::$TABLE_NAME] = $cursorArray;
            } else {
                $response[Customer::$TABLE_NAME . "status"] = false;
            }

//BILL DETAIL
            $billQuery = "SELECT " . BillDetail::$TABLE_NAME . ".* FROM
" . BillDetail::$TABLE_NAME . " INNER JOIN " . Customer::$TABLE_NAME . " ON
" . BillDetail::$TABLE_NAME . "." . BillDetail::$COLUMN_CUST_ID . " =
" . Customer::$TABLE_NAME . "." . Customer::$ID . "
WHERE " . Customer::$TABLE_NAME . "." . Customer::$STAFF_ID . " = '1'";

            $billQueryResult = mysqli_query($conn, $billQuery);
            if (mysqli_num_rows($billQueryResult) > 0) {
                $cursorArray = array();
                $temp = array();
                while ($row = mysqli_fetch_assoc($billQueryResult)) {
                    $temp[BillDetail::$ID] = $row[BillDetail::$ID];
                    $temp[BillDetail::$COLUMN_DATE] = $row[BillDetail::$COLUMN_DATE];
                    $temp[BillDetail::$COLUMN_CUST_ID] = $row[BillDetail::$COLUMN_CUST_ID];
                    $temp[BillDetail::$COLUMN_PRICE] = $row[BillDetail::$COLUMN_PRICE];
                    $temp[BillDetail::$COLUMN_QTY] = $row[BillDetail::$COLUMN_QTY];
                    $temp[BillDetail::$COLUMN_RETURNED_TOTAL] = $row[BillDetail::$COLUMN_RETURNED_TOTAL];
                    $temp[BillDetail::$COLUMN_CURRENT_TOTAL] = $row[BillDetail::$COLUMN_CURRENT_TOTAL];
                    $temp[BillDetail::$COLUMN_PAID] = $row[BillDetail::$COLUMN_PAID];
                    $temp[BillDetail::$COLUMN_DUE] = $row[BillDetail::$COLUMN_DUE];
                    array_push($cursorArray, $temp);
                }
                $response[BillDetail::$TABLE_NAME] = $cursorArray;
            } else {
                $response[BillDetail::$TABLE_NAME . "status"] = false;
            }
//CART
            $cartQuery = "SELECT " . Cart::$TABLE_NAME . ".* FROM
" . Cart::$TABLE_NAME . " INNER JOIN " . BillDetail::$TABLE_NAME . " ON
" . Cart::$TABLE_NAME . "." . Cart::$COLUMN_BILL_ID . " =
" . BillDetail::$TABLE_NAME . "." . BillDetail::$ID . "
 INNER JOIN " . Customer::$TABLE_NAME . " ON
" . BillDetail::$TABLE_NAME . "." . BillDetail::$COLUMN_CUST_ID . " =
" . Customer::$TABLE_NAME . "." . Customer::$ID . "
WHERE " . Customer::$TABLE_NAME . "." . Customer::$STAFF_ID . " = '1'";

            $cartQueryResult = mysqli_query($conn, $cartQuery);
            if (mysqli_num_rows($cartQueryResult) > 0) {
                $cursorArray = array();
                $temp = array();
                while ($row = mysqli_fetch_assoc($cartQueryResult)) {
                    $temp[Cart::$ID] = $row[Cart::$ID];
                    $temp[Cart::$COLUMN_BILL_ID] = $row[Cart::$COLUMN_BILL_ID];
                    $temp[Cart::$COLUMN_ITEM_ID] = $row[Cart::$COLUMN_ITEM_ID];
                    $temp[Cart::$COLUMN_NAME] = $row[Cart::$COLUMN_NAME];
                    $temp[Cart::$COLUMN_BRAND] = $row[Cart::$COLUMN_BRAND];
                    $temp[Cart::$COLUMN_CATEGORY] = $row[Cart::$COLUMN_CATEGORY];
                    $temp[Cart::$COLUMN_PRICE] = $row[Cart::$COLUMN_PRICE];
                    $temp[Cart::$COLUMN_QTY] = $row[Cart::$COLUMN_QTY];
                    $temp[Cart::$COLUMN_TOTAL] = $row[Cart::$COLUMN_TOTAL];
                    $temp[Cart::$COLUMN_RETURN_QTY] = $row[Cart::$COLUMN_RETURN_QTY];
                    array_push($cursorArray, $temp);
                }
                $response[Cart::$TABLE_NAME] = $cursorArray;
            } else {
                $response[Cart::$TABLE_NAME . "status"] = false;
            }
//SALES RETURN
            $salesReturnQuery = "SELECT " . SalesReturn::$TABLE_NAME . ".* FROM
" . SalesReturn::$TABLE_NAME . " INNER JOIN " . BillDetail::$TABLE_NAME . " ON
" . SalesReturn::$TABLE_NAME . "." . SalesReturn::$COLUMN_BILL_ID . " =
" . BillDetail::$TABLE_NAME . "." . BillDetail::$ID . "
 INNER JOIN " . Customer::$TABLE_NAME . " ON
" . BillDetail::$TABLE_NAME . "." . BillDetail::$COLUMN_CUST_ID . " =
" . Customer::$TABLE_NAME . "." . Customer::$ID . "
WHERE " . Customer::$TABLE_NAME . "." . Customer::$STAFF_ID . " = '1'";

            $salesReturnQueryResult = mysqli_query($conn, $salesReturnQuery);
            if (mysqli_num_rows($salesReturnQueryResult) > 0) {
                $cursorArray = array();
                $temp = array();
                while ($row = mysqli_fetch_assoc($salesReturnQueryResult)) {
                    $temp[SalesReturn::$ID] = $row[SalesReturn::$ID];
                    $temp[SalesReturn::$COLUMN_DATE] = $row[SalesReturn::$COLUMN_DATE];
                    $temp[SalesReturn::$COLUMN_BILL_ID] = $row[SalesReturn::$COLUMN_BILL_ID];
                    $temp[SalesReturn::$COLUMN_ITEM_ID] = $row[SalesReturn::$COLUMN_ITEM_ID];
                    $temp[SalesReturn::$COLUMN_PRICE] = $row[SalesReturn::$COLUMN_PRICE];
                    $temp[SalesReturn::$COLUMN_QTY] = $row[SalesReturn::$COLUMN_QTY];
                    $temp[SalesReturn::$COLUMN_TOTAL] = $row[SalesReturn::$COLUMN_TOTAL];
                    array_push($cursorArray, $temp);
                }
                $response[SalesReturn::$TABLE_NAME] = $cursorArray;
            } else {
                $response[SalesReturn::$TABLE_NAME . "status"] = false;
            }
//PAYMENT
            $paymentQuery = "SELECT " . Payment::$TABLE_NAME . ".* FROM
" . Payment::$TABLE_NAME . " INNER JOIN " . BillDetail::$TABLE_NAME . " ON
" . Payment::$TABLE_NAME . "." . Payment::$COLUMN_BILL_ID . " =
" . BillDetail::$TABLE_NAME . "." . BillDetail::$ID . "
 INNER JOIN " . Customer::$TABLE_NAME . " ON
" . BillDetail::$TABLE_NAME . "." . BillDetail::$COLUMN_CUST_ID . " =
" . Customer::$TABLE_NAME . "." . Customer::$ID . "
WHERE " . Customer::$TABLE_NAME . "." . Customer::$STAFF_ID . " = '1'";

            $paymentQueryResult = mysqli_query($conn, $paymentQuery);
            if (mysqli_num_rows($paymentQueryResult) > 0) {
                $cursorArray = array();
                $temp = array();
                while ($row = mysqli_fetch_assoc($paymentQueryResult)) {
                    $temp[Payment::$ID] = $row[Payment::$ID];
                    $temp[Payment::$COLUMN_BILL_ID] = $row[Payment::$COLUMN_BILL_ID];
                    $temp[Payment::$COLUMN_DATE] = $row[Payment::$COLUMN_DATE];
                    $temp[Payment::$COLUMN_AMOUNT] = $row[Payment::$COLUMN_AMOUNT];
                    array_push($cursorArray, $temp);
                }
                $response[Payment::$TABLE_NAME] = $cursorArray;
            } else {
                $response[Payment::$TABLE_NAME . "status"] = false;
            }

//***********************************************************END***********************************************/
        }
    } else {
        $response["status"] = "USER";
    }
}

echo json_encode($response);
