<?php
require('../stripe_config.php');
session_start();
$response = array();
$userID = $_SESSION["userID"];
$adminID = $_SESSION["adminID"];
$invoice_id = $_GET["invoice_id"];
$amount = $_POST['amount'];
$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {
    $sql = "SELECT * FROM INVOICE LEFT JOIN PARENT ON INVOICE.PARENT_ID = PARENT.PARENT_ID WHERE INVOICE.INVOICE_ID = '$invoice_id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_invoice_amount = $row["INVOICE_AMOUNT"];
        $db_invoice_date = $row["INVOICE_DATE"];
        $parent_name = $row["PARENT_NAME"];
    }
    if ($amount == $db_invoice_amount) {
        if (isset($_POST['stripeToken'])) {
            try {
                \Stripe\Stripe::setVerifySslCerts(false);

                $token = $_POST["stripeToken"];
                $amount_for_stripe = $amount * 100;
                $data = \Stripe\Charge::create(array(
                    "amount" => $amount_for_stripe,
                    "currency" => "myr",
                    "description" => 'Invoice #' . $invoice_id,
                    "source" => $token,

                ));
                $sql2 = "UPDATE INVOICE SET INVOICE_STATUS = 'paid' WHERE INVOICE_ID = '$invoice_id' AND PARENT_ID = '$userID' ";
                
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $date = new DateTime();
                $currentDate = $date->format('Y-m-d');

                $sql3 = "INSERT INTO PAYMENT_RECEIPT (RECEIPT_ID,INVOICE_ID,RECEIPT_DATE,RECEIPT_AMOUNT,RECEIPT_DESC,RECEIPT_TYPE,RECEIPT_FILEPATH) 
                VALUES ('','$invoice_id','$currentDate','$amount','Card Payment','card',NULL)";
                if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
                    header("Location: PPaymentDone.php");
                } else {
                    die('mysql error');
                }
            } catch (\Stripe\Exception\CardException $e) {
                echo 'fail';
                header("Location: PPaymentError.php");
            }
        }
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

    } else {
        die('amount and invoice amount not same, error!');
    }
} else {
    die("FATAL ERROR");
}

$conn->close();

echo json_encode($response);
