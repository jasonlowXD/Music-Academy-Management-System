<?php
session_start();
$response = array();
$userID = $_SESSION["userID"];
$invoice_id = $_GET["invoice_id"];
$invoiceDescName = $_POST['invoiceDescName'];
$invoiceDescPrice = $_POST['invoiceDescPrice'];
$totalAmount = $_POST['totalAmount'];
$invoiceStatus = $_POST['invoiceStatus'];

$invoiceDesc = '';

$descLineNum = count($invoiceDescName);
for ($x = 0; $x < $descLineNum; $x++) {
    $invoiceDesc .= $invoiceDescName[$x] . ',' . $invoiceDescPrice[$x] . '\n';
}


$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {
    $sql = "SELECT * FROM INVOICE WHERE INVOICE_ID = '$invoice_id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_invoice_amount = $row["INVOICE_AMOUNT"];
        $db_invoice_status = $row["INVOICE_STATUS"];
        $db_invoice_desc = $row["INVOICE_DESC"];
        $db_invoice_desc = str_replace("\n", '\n', $db_invoice_desc);
    }

    // IF NOTHING CHANGE
    if ($invoiceDesc == $db_invoice_desc && $totalAmount == $db_invoice_amount && $invoiceStatus ==  $db_invoice_status) {
        $response['title']  = 'Nothing Changed!';
        $response['status']  = 'info';
        $response['message'] = 'All info are same!';
    } 
    // IF GOT CHANGES
    else {
        $sql2 = "UPDATE INVOICE SET INVOICE_DESC ='$invoiceDesc', INVOICE_AMOUNT = '$totalAmount', INVOICE_STATUS = '$invoiceStatus' WHERE INVOICE_ID = '$invoice_id' AND ADMIN_ID = '$userID' ";
        if (mysqli_query($conn, $sql2)) {
            $response['title']  = 'Done!';
            $response['status']  = 'success';
            $response['message'] = 'Invoice edited!';
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'update invoice mysql error';
        }
    }
} else {
    die("FATAL ERROR");
}

$conn->close();

echo json_encode($response);
