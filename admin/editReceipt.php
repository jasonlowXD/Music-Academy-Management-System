<?php
ob_get_contents();
ob_end_clean();

//IF THE POST FILE SIZE IS LARGER THAN POST_MAX_SIZE IN PHP.INI (CURRENTLY SET POST_MAX_SIZE AS 1000M ONLY)
if ($_SERVER["CONTENT_LENGTH"] > ((int)ini_get('post_max_size') * 1024 * 1024)) {
    // $num1 = $_SERVER["CONTENT_LENGTH"] ;
    // $num = ((int)ini_get('post_max_size')* 1024 * 1024);
    $response['title']  = 'Error receipt file';
    $response['status']  = 'error';
    // $response['message'] = 'Too large jor la oiii '. $num1 .' more than '. $num.' already!';
    $response['message'] = 'File must not more than 2 megabytes!';
} else {
    $noFileInput = false;
    $fileError = false;
    $fileErrorSize = false;
    $fileErrorType = false;
    $flag = false;
    session_start();
    $response = array();
    $userID = $_SESSION["userID"];
    $receipt_id = $_GET["receipt_id"];
    $receiptDate = $_POST['receiptDate'];
    $amount = $_POST['amount'];
    $desc = $_POST['desc'];
    $receiptType = $_POST['receiptType'];

    // THIS IS OLD FILE PATH
    if (!empty($_POST['oldFile'])) {
        $oldFile = $_POST['oldFile'];
        $filePath = $oldFile;
    } else {
        $oldFile = NULL;
    }

    $maxsize    = 2097152; // 2MB
    $acceptable = array(
        'application/pdf',
        'image/jpeg',
        'image/jpg',
        'image/png'
    );

    // IF FILE UPLOAD BUT GOT ERROR
    if ($_FILES["receiptFile"]["error"] != 0 && $_FILES["receiptFile"]["error"] != 4) {
        $fileError = true;
    }
    // IF NO NEW FILE UPLOAD AND NO OLD FILE PATH, SET FILEPATH TO NULL
    else if ($_FILES["receiptFile"]["error"] == 4) {
        if ($oldFile == null) {
            $filePath = null;
        }
        $noFileInput = true;
    }

    // IF FILE SIZE TOO BIG 
    else if ($_FILES['receiptFile']['size'] > $maxsize) {
        $fileErrorSize = true;
    }
    // IF FILE TYPE WRONG 
    else if ((!in_array($_FILES['receiptFile']['type'], $acceptable)) && (!empty($_FILES['receiptFile']["type"]))) {
        $fileErrorType = true;
    }

    // IF NO ERROR IN NEW FILE, SET NEW FILE PATH
    if (!$fileErrorSize && !$fileErrorType && !$fileError && !$noFileInput) {
        $target_dir = "../localFolder/receipt/";
        $filePath = $target_dir . $_FILES['receiptFile']['name'];
    }

    $conn = mysqli_connect("localhost", "root", "", "music_academy");
    if ($conn) {
        if ($fileErrorSize) {
            $response['title']  = 'Error receipt file';
            $response['status']  = 'error';
            $response['message'] = 'File must not more than 2 megabytes!';
        } else if ($fileErrorType) {
            $response['title']  = 'Error receipt file';
            $response['status']  = 'error';
            $response['message'] = 'Invalid file type, please check again!';
        } else if ($fileError) {
            $response['title']  = 'Error receipt file';
            $response['status']  = 'error';
            $response['message'] = 'File upload got error!';
        } // IF NEW UPLOADED FILE NO ERROR OR NO FILE UPLOAD
        else {

            $sql = "SELECT * FROM PAYMENT_RECEIPT WHERE RECEIPT_ID = '$receipt_id'";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $db_invoice_id = $row["INVOICE_ID"];
                $db_receipt_date = $row["RECEIPT_DATE"];
                $db_receipt_amount = $row["RECEIPT_AMOUNT"];
                $db_receipt_desc = $row["RECEIPT_DESC"];
                $db_receipt_type = $row["RECEIPT_TYPE"];
                $db_receipt_filepath = $row["RECEIPT_FILEPATH"];
            }

            // IF NOTHING CHANGE
            if ($db_receipt_date == $receiptDate && $db_receipt_amount == $amount && $db_receipt_desc ==  $desc && $db_receipt_type ==  $receiptType && $db_receipt_filepath ==  $filePath) {
                $response['title']  = 'Nothing Changed!';
                $response['status']  = 'info';
                $response['message'] = 'All info are same!';
            }
            // IF GOT CHANGE
            else {
                $sql2 = "UPDATE PAYMENT_RECEIPT SET RECEIPT_DATE ='$receiptDate', RECEIPT_AMOUNT = '$amount', RECEIPT_DESC = '$desc', RECEIPT_TYPE = '$receiptType', RECEIPT_FILEPATH = '$filePath' WHERE RECEIPT_ID = '$receipt_id'";

                // IF FILEPATH IS NULL OR FILEPATH SAME AS DATABASE FILEPATH 
                if ($filePath == NULL || $filePath == $db_receipt_filepath) {
                    if (mysqli_query($conn, $sql2)) {
                        $flag = true;
                    } else {
                        $response['title']  = 'Error!';
                        $response['status']  = 'error';
                        $response['message'] = 'mysql error';
                    }
                }
                // IF IS NEW FILEPATH 
                else if ($filePath != $db_receipt_filepath) {
                    if (move_uploaded_file($_FILES['receiptFile']['tmp_name'], $filePath) && mysqli_query($conn, $sql2)) {
                        $flag = true;
                    } else {
                        $response['title']  = 'Error!';
                        $response['status']  = 'error';
                        $response['message'] = 'file move and mysql error';
                    }
                }

                // IF PAYMENT RECEIPT EDITED SUCCESS, SUM ALL AMOUNT OF RECEIPT WITH SAME INVOICE_ID AND COMPARE WITH INVOICE, IF TOTAL_PAYMENT_AMOUNT >= INVOICE_AMOUNT, CHANGE INVOICE STATUS 
                if ($flag) {
                    $total_receipt_amount = 0;
                    $sql3 = "SELECT RECEIPT_AMOUNT FROM PAYMENT_RECEIPT WHERE INVOICE_ID = '$db_invoice_id'";
                    $result3 = $conn->query($sql3);
                    while ($row3 = $result3->fetch_assoc()) {
                        $total_receipt_amount += $row3['RECEIPT_AMOUNT'];
                    }
                    $sql4 = "SELECT INVOICE_AMOUNT FROM INVOICE WHERE INVOICE_ID = '$db_invoice_id'";
                    $result4 = $conn->query($sql4);
                    while ($row4 = $result4->fetch_assoc()) {
                        $invoice_amount = $row4['INVOICE_AMOUNT'];
                    }
                    if ($total_receipt_amount >= $invoice_amount) {
                        $sql5 = "UPDATE INVOICE SET INVOICE_STATUS = 'paid' WHERE INVOICE_ID = '$db_invoice_id' AND ADMIN_ID = '$userID'";
                        if (mysqli_query($conn, $sql5)) {
                            $response['title']  = 'Done!';
                            $response['status']  = 'success';
                            $response['message'] = 'Receipt edited!';
                        } else {
                            $response['title']  = 'Error!';
                            $response['status']  = 'error';
                            $response['message'] = 'update invoice mysql error';
                        }
                    } else if ($total_receipt_amount < $invoice_amount) {
                        $sql6 = "UPDATE INVOICE SET INVOICE_STATUS = 'unpaid' WHERE INVOICE_ID = '$db_invoice_id' AND ADMIN_ID = '$userID'";
                        if (mysqli_query($conn, $sql6)) {
                            $response['title']  = 'Done!';
                            $response['status']  = 'success';
                            $response['message'] = 'Receipt edited!';
                        } else {
                            $response['title']  = 'Error!';
                            $response['status']  = 'error';
                            $response['message'] = 'update invoice mysql error';
                        }
                    }
                }
            }
        }
    } else {
        die("FATAL ERROR");
    }
    $conn->close();
}

echo json_encode($response);
