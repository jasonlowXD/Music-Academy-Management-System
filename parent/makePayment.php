<?php
session_start();
$response = array();
$userID = $_SESSION["userID"];
$adminID = $_SESSION["adminID"];
$invoice_id = $_GET["invoice_id"];
$card_num = $_POST['card_num'];
$expire_date = $_POST['expire_date'];
$cvc = $_POST['cvc'];
$name_of_card = $_POST['name_of_card'];
$totalAmount = $_POST['totalAmount'];

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {
    $sql = "SELECT * FROM INVOICE LEFT JOIN PARENT ON INVOICE.PARENT_ID = PARENT.PARENT_ID WHERE INVOICE.INVOICE_ID = '$invoice_id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_invoice_amount = $row["INVOICE_AMOUNT"];
        $db_invoice_date = $row["INVOICE_DATE"];
        $parent_name = $row["PARENT_NAME"];
    }
    if ($totalAmount == $db_invoice_amount) {
        // $sql2 = "UPDATE INVOICE SET INVOICE_STATUS = 'paid' WHERE INVOICE_ID = '$invoice_id' AND PARENT_ID = '$userID' ";

        // $monthName = date('F', strtotime($db_invoice_date));

        // // NOTIFY ADMIN
        // $title = 'Invoice paid complete';
        // $content = $parent_name . ' has paid complete ' . $monthName . ' invoice #' . $invoice_id . '.';
        // $status = 'unseen';
        // $admin_link = 'AInvoice.php';

        // $sql3 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
        // VALUES ('','$adminID',NULL,NULL,'$title','$content','$status',CURRENT_TIMESTAMP(),'$admin_link')";

        // if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
        // $response['title']  = 'Done!';
        // $response['status']  = 'success';
        // $response['message'] = 'Invoice edited!';
        // } else {
        //     $response['title']  = 'Error!';
        //     $response['status']  = 'error';
        //     $response['message'] = 'update invoice mysql error';
        // }

        $response['title']  = 'Done!';
        $response['status']  = 'success';
        $response['message'] = 'Invoice edited!';
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'error total amount, please refresh';
    }
} else {
    die("FATAL ERROR");
}

$conn->close();

echo json_encode($response);
