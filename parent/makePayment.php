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
    // if ($amount == $db_invoice_amount) {
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

            date_default_timezone_set("Asia/Kuala_Lumpur");
            $date = new DateTime();
            $currentDate = $date->format('Y-m-d');

            $filepath = null;
            $sql2 = "INSERT INTO PAYMENT_RECEIPT (RECEIPT_ID,INVOICE_ID,RECEIPT_DATE,RECEIPT_AMOUNT,RECEIPT_DESC,RECEIPT_TYPE,RECEIPT_FILEPATH) 
                VALUES ('','$invoice_id','$currentDate','$amount','Card Payment','card','$filepath')";

            if (mysqli_query($conn, $sql2)) {

                $sql3 = "SELECT * FROM PAYMENT_RECEIPT WHERE INVOICE_ID = '$invoice_id'";
                $result3 = $conn->query($sql3);
                $receipt_total_amount = 0;
                while ($row3 = $result3->fetch_assoc()) {
                    $receipt_amount = $row3["RECEIPT_AMOUNT"];
                    $receipt_total_amount += $receipt_amount;
                }

                if ($receipt_total_amount >= $db_invoice_amount) {
                    $sql4 = "UPDATE INVOICE SET INVOICE_STATUS = 'paid' WHERE INVOICE_ID = '$invoice_id' AND PARENT_ID = '$userID' ";
                    if (mysqli_query($conn, $sql4)) {
                        header("Location: PPaymentDone.php");
                    } else {
                        die('update invoice sql error');
                    }
                } else {
                    header("Location: PPaymentDone.php");
                }
            } else {
                die('mysql error');
            }
        } catch (\Stripe\Exception\CardException $e) {
            header("Location: PPaymentError.php");
            // Since it's a decline, \Stripe\Exception\CardException will be caught
            // echo 'Status is:' . $e->getHttpStatus() . '\n';
            // echo 'Type is:' . $e->getError()->type . '\n';
            // echo 'Code is:' . $e->getError()->code . '\n';
            // param is '' in this case
            // echo 'Param is:' . $e->getError()->param . '\n';
            // echo 'Message is:' . $e->getError()->message . '\n';
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            header("Location: PPaymentError.php");
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            header("Location: PPaymentError.php");
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            header("Location: PPaymentError.php");
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            header("Location: PPaymentError.php");
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            header("Location: PPaymentError.php");
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            header("Location: PPaymentError.php");
        }
    }

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

    // } else {
    //     die('amount and invoice amount not same, error!');
    // }
} else {
    die("FATAL ERROR");
}

$conn->close();

echo json_encode($response);
