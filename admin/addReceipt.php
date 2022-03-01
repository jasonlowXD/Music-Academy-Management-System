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
    $invoiceID = $_POST['invoiceID'];
    $receiptDate = $_POST['receiptDate'];
    $amount = $_POST['amount'];
    $desc = $_POST['desc'];
    $receiptType = $_POST['receiptType'];

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
    // IF NO FILE UPLOAD
    else if ($_FILES["receiptFile"]["error"] == 4) {
        $filePath = NULL;
        $noFileInput = true;
    }
    // IF GOT FILE UPLOAD 
    // IF FILE SIZE TOO BIG 
    else if ($_FILES['receiptFile']['size'] > $maxsize) {
        $fileErrorSize = true;
    }
    // IF FILE TYPE WRONG 
    else if ((!in_array($_FILES['receiptFile']['type'], $acceptable)) && (!empty($_FILES['receiptFile']["type"]))) {
        $fileErrorType = true;
    }

    // IF NO ERROR IN FILE, SET FILE PATH
    if (!$fileErrorSize && !$fileErrorType && !$fileError && !$noFileInput) {
        if (!file_exists('../localFolder/receipt/')) {
            mkdir('../localFolder/receipt/', 0777, true);
            $target_dir = "../localFolder/receipt/";
            $filePath = $target_dir . $_FILES['receiptFile']['name'];
        } else {
            $target_dir = "../localFolder/receipt/";
            $filePath = $target_dir . $_FILES['receiptFile']['name'];
        }
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
        }

        // IF UPLOADED FILE NO ERROR OR NO FILE UPLOAD
        else {
            $sql = "INSERT INTO PAYMENT_RECEIPT (RECEIPT_ID,INVOICE_ID,RECEIPT_DATE,RECEIPT_AMOUNT,RECEIPT_DESC,RECEIPT_TYPE,RECEIPT_FILEPATH) 
            VALUES ('','$invoiceID','$receiptDate','$amount','$desc','$receiptType','$filePath')";
            if ($filePath == NULL) {
                if (mysqli_query($conn, $sql)) {
                    $flag = true;
                } else {
                    $response['title']  = 'Error!';
                    $response['status']  = 'error';
                    $response['message'] = 'mysql error';
                }
            } else {
                if (move_uploaded_file($_FILES['receiptFile']['tmp_name'], $filePath) && mysqli_query($conn, $sql)) {
                    $flag = true;
                } else {
                    $response['title']  = 'Error!';
                    $response['status']  = 'error';
                    $response['message'] = 'file move and mysql error';
                }
            }

            // IF PAYMENT RECEIPT ADDED SUCCESS, SUM ALL AMOUNT OF RECEIPT WITH SAME INVOICE_ID AND COMPARE WITH INVOICE, IF TOTAL_PAYMENT_AMOUNT >= INVOICE_AMOUNT, CHANGE INVOICE STATUS 
            if ($flag) {
                $total_receipt_amount = 0;
                $sql2 = "SELECT RECEIPT_AMOUNT FROM PAYMENT_RECEIPT WHERE INVOICE_ID = '$invoiceID'";
                $result2 = $conn->query($sql2);
                while ($row2 = $result2->fetch_assoc()) {
                    $total_receipt_amount += $row2['RECEIPT_AMOUNT'];
                }
                $sql3 = "SELECT INVOICE_AMOUNT FROM INVOICE WHERE INVOICE_ID = '$invoiceID'";
                $result3 = $conn->query($sql3);
                while ($row3 = $result3->fetch_assoc()) {
                    $invoice_amount = $row3['INVOICE_AMOUNT'];
                }
                if ($total_receipt_amount >= $invoice_amount) {
                    $sql4 = "UPDATE INVOICE SET INVOICE_STATUS = 'paid' WHERE INVOICE_ID = '$invoiceID' AND ADMIN_ID = '$userID'";
                    if (mysqli_query($conn, $sql4)) {
                        $response['title']  = 'Done!';
                        $response['status']  = 'success';
                        $response['message'] = 'New receipt added!';
                    } else {
                        $response['title']  = 'Error!';
                        $response['status']  = 'error';
                        $response['message'] = 'update invoice mysql error';
                    }
                } else {
                    $response['title']  = 'Done!';
                    $response['status']  = 'success';
                    $response['message'] = 'New receipt added!';
                }
            }
        }
    } else {
        die("FATAL ERROR");
    }
    $conn->close();
}
echo json_encode($response);
