<?php
include 'common/common.php';

$itemInsert = false;

$AppSyncTableQuery = "CREATE TABLE IF NOT EXISTS " . AppSync::$TABLE_NAME . " (
    " . AppSync::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . AppSync::$COLUMN_OP_CODE . " VARCHAR(100) ,
    " . AppSync::$COLUMN_TIMESTAMP . " BIGINT ,
    " . AppSync::$COLUMN_ROW_ID . " VARCHAR(100) ,
    " . AppSync::$COLUMN_TABLE_NAME . " VARCHAR(100) ,
    " . AppSync::$COLUMN_OPERATION . " VARCHAR(100)
)ENGINE = INNODB;";

if (mysqli_query($conn, $AppSyncTableQuery)) {
    echo "<br>Table AppSyncTableQuery created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

echo "<br><br><br>";

$StaffTableQuery = "CREATE TABLE IF NOT EXISTS " . Staff::$TABLE_NAME . " (
    " . Staff::$ID . " VARCHAR(100) PRIMARY KEY ,
    " . Staff::$COLUMN_NAME . " VARCHAR(100) ,
    " . Staff::$COLUMN_USER_NAME . " VARCHAR(100) ,
    " . Staff::$COLUMN_PASSWORD . " VARCHAR(100) ,
    " . Staff::$COLUMN_EMAIL . " VARCHAR(100) ,
    " . Staff::$COLUMN_PRECISION . " INT UNSIGNED AUTO_INCREMENT UNIQUE,
    " . Staff::$COLUMN_FORCE . " INT ,
    " . Staff::$COLUMN_UPDATE . " INT
)ENGINE = INNODB;";

if (mysqli_query($conn, $StaffTableQuery)) {
    echo "<br>Table StaffTableQuery created successfully<br>";
    $insertDummyStaff = "INSERT INTO `tb_staff`(`tb_staff_id`, `tb_staff_name`, `tb_staff_username`, `tb_staff_password`, `tb_staff_email`,
    `tb_staff_precision`, `tb_staff_force`, `tb_staff_update`)
   VALUES ('1','USER','user','user','user@gmail.com','1','1','0')";
    if (mysqli_query($conn, $insertDummyStaff)) {
        echo "<br>Successfully Inserted Dummy Data";
    } else {
        echo "<br>Failed To Insert Dummy Data";
    }
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

echo "<br><br><br>";

$ItemTableQuery = "CREATE TABLE IF NOT EXISTS " . Item::$TABLE_NAME . " (
    " . Item::$ID . " VARCHAR(100) PRIMARY KEY ,
    " . Item::$COLUMN_BARCODE . " VARCHAR(100) ,
    " . Item::$COLUMN_NAME . " VARCHAR(100) ,
    " . Item::$COLUMN_BRAND . " VARCHAR(100) ,
    " . Item::$COLUMN_CATEGORY . " VARCHAR(100) ,
    " . Item::$COLUMN_PRICE . " DECIMAL(12,3)
)ENGINE = INNODB;";

if (mysqli_query($conn, $ItemTableQuery)) {
    echo "<br>Table ItemTable created successfully<br>";
    $itemInsert = true;
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

echo "<br><br><br>";

$CustomerTableQuery = "CREATE TABLE IF NOT EXISTS " . Customer::$TABLE_NAME . " (
    " . Customer::$ID . " VARCHAR(100) PRIMARY KEY ,
    " . Customer::$STAFF_ID . " VARCHAR(100) ,
    " . Customer::$COLUMN_BARCODE . " VARCHAR(100) ,
    " . Customer::$COLUMN_CR_NO . " VARCHAR(100) ,
    " . Customer::$COLUMN_SHOP_NAME . " VARCHAR(100) ,
    " . Customer::$COLUMN_DAY . " VARCHAR(100) ,
    " . Customer::$COLUMN_NAME . " VARCHAR(100) ,
    " . Customer::$COLUMN_PHONE . " VARCHAR(100) ,
    " . Customer::$COLUMN_EMAIL . " VARCHAR(100) ,
    " . Customer::$COLUMN_TELEPHONE . " VARCHAR(100) ,
    " . Customer::$COLUMN_VAT_NO . " VARCHAR(100) ,
    " . Customer::$COLUMN_ADDRESS . " VARCHAR(100)
)ENGINE = INNODB;";

if (mysqli_query($conn, $CustomerTableQuery)) {
    echo "<br>Table CustomerTable created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

echo "<br><br><br>";

$BillDetailTableQuery = "CREATE TABLE IF NOT EXISTS " . BillDetail::$TABLE_NAME . " (
    " . BillDetail::$ID . " VARCHAR(100) PRIMARY KEY ,
    " . BillDetail::$COLUMN_DATE . " VARCHAR(100) ,
    " . BillDetail::$COLUMN_CUST_ID . " VARCHAR(100) ,
    " . BillDetail::$COLUMN_PRICE . " DECIMAL(12,3) ,
    " . BillDetail::$COLUMN_QTY . " INT ,
    " . BillDetail::$COLUMN_RETURNED_TOTAL . " DECIMAL(12,3) ,
    " . BillDetail::$COLUMN_CURRENT_TOTAL . " DECIMAL(12,3) ,
    " . BillDetail::$COLUMN_PAID . " DECIMAL(12,3) ,
    " . BillDetail::$COLUMN_DUE . " DECIMAL(12,3)

)ENGINE = INNODB;";

if (mysqli_query($conn, $BillDetailTableQuery)) {
    echo "<br>Table BillDetailTable created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

echo "<br><br><br>";

$CartTableQuery = "CREATE TABLE IF NOT EXISTS " . Cart::$TABLE_NAME . " (
    " . Cart::$ID . " VARCHAR(100) PRIMARY KEY ,
    " . Cart::$COLUMN_BILL_ID . " VARCHAR(100) ,
    " . Cart::$COLUMN_ITEM_ID . " VARCHAR(100) ,
    " . Cart::$COLUMN_NAME . " VARCHAR(100) ,
    " . Cart::$COLUMN_BRAND . " VARCHAR(100) ,
    " . Cart::$COLUMN_CATEGORY . " VARCHAR(100) ,
    " . Cart::$COLUMN_PRICE . " DECIMAL(12,3) ,
    " . Cart::$COLUMN_QTY . " INT ,
    " . Cart::$COLUMN_TOTAL . " DECIMAL(12,3) ,
    " . Cart::$COLUMN_RETURN_QTY . " INT
)ENGINE = INNODB;";

if (mysqli_query($conn, $CartTableQuery)) {
    echo "<br>Table CartTable created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

echo "<br><br><br>";

$SalesReturnTableQuery = "CREATE TABLE IF NOT EXISTS " . SalesReturn::$TABLE_NAME . " (
    " . SalesReturn::$ID . " VARCHAR(100) PRIMARY KEY ,
    " . SalesReturn::$COLUMN_DATE . " VARCHAR(100) ,
    " . SalesReturn::$COLUMN_BILL_ID . " VARCHAR(100) ,
    " . SalesReturn::$COLUMN_ITEM_ID . " VARCHAR(100) ,
    " . SalesReturn::$COLUMN_PRICE . " DECIMAL(12,3) ,
    " . SalesReturn::$COLUMN_QTY . " INT ,
    " . SalesReturn::$COLUMN_TOTAL . " DECIMAL(12,3)
)ENGINE = INNODB;";

if (mysqli_query($conn, $SalesReturnTableQuery)) {
    echo "<br>Table SalesReturnTable created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

echo "<br><br><br>";

$PaymentTableQuery = "CREATE TABLE IF NOT EXISTS " . Payment::$TABLE_NAME . " (
    " . Payment::$ID . " VARCHAR(100) PRIMARY KEY ,
    " . Payment::$COLUMN_BILL_ID . " VARCHAR(100) ,
    " . Payment::$COLUMN_DATE . " VARCHAR(100) ,
    " . Payment::$COLUMN_AMOUNT . " DECIMAL(12,3)
)ENGINE = INNODB;";

if (mysqli_query($conn, $PaymentTableQuery)) {
    echo "<br>Table PaymentTable created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

if ($itemInsert) {

    $insertItemData = "INSERT INTO `tb_item`( `tb_item_id`, `tb_item_co_barcode`, `tb_item_name`, `tb_item_brand`, `tb_item_category`, `tb_item_price`)
    VALUES ('1','1','A','AA','AAA','100');";
    $insertItemData .= "INSERT INTO `tb_item`( `tb_item_id`, `tb_item_co_barcode`, `tb_item_name`, `tb_item_brand`, `tb_item_category`, `tb_item_price`)
    VALUES ('2','2','B','BB','BBB','200.50');";
    $insertItemData .= "INSERT INTO `tb_item`( `tb_item_id`, `tb_item_co_barcode`, `tb_item_name`, `tb_item_brand`, `tb_item_category`, `tb_item_price`)
    VALUES ('3','3','C','CC','CCC','300');";
    $insertItemData .= "INSERT INTO `tb_item`( `tb_item_id`, `tb_item_co_barcode`, `tb_item_name`, `tb_item_brand`, `tb_item_category`, `tb_item_price`)
    VALUES ('4','4','D','DD','DDD','400.222');";
    $insertItemData .= "INSERT INTO `tb_item`( `tb_item_id`, `tb_item_co_barcode`, `tb_item_name`, `tb_item_brand`, `tb_item_category`, `tb_item_price`)
    VALUES ('5','5','E','EE','EEE','500.555');";
    if (mysqli_multi_query($conn, $insertItemData)) {
        echo "<br>Item records created successfully";
    } else {
        echo "Error: " . $insertItemData . "<br>" . mysqli_error($conn);
    }
}
