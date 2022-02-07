<?php
ob_get_contents();
ob_end_clean();

//IF THE POST FILE SIZE IS LARGER THAN POST_MAX_SIZE IN PHP.INI (CURRENTLY SET POST_MAX_SIZE AS 1000M ONLY)
if ($_SERVER["CONTENT_LENGTH"] > ((int)ini_get('post_max_size') * 1024 * 1024)) {
    // $num1 = $_SERVER["CONTENT_LENGTH"] ;
    // $num = ((int)ini_get('post_max_size')* 1024 * 1024);
    $response['title']  = 'Error practice progress file';
    $response['status']  = 'error';
    // $response['message'] = 'Too large jor la oiii '. $num1 .' more than '. $num.' already!';
    $response['message'] = 'File must not more than 500 Megabytes!';
} else {
    $noFileInput = false;
    $fileError = false;
    $fileErrorSize = false;
    $fileErrorType = false;
    session_start();
    $response = array();
    $userID = $_SESSION["userID"];
    $child = $_POST['child'];
    $title = $_POST['title'];
    $courseName = $_POST['courseName'];


    // $temp_name  = $_FILES['resourceFile']['error'];
    // $response['title']  = 'check';
    // $response['status']  = 'error';
    // $response['message'] = strval($temp_name);


    $maxsize    = 524288000; // 500MB
    $acceptable = array(
        'video/mp4',
        'video/webm',
    );

    // IF FILE UPLOAD BUT GOT ERROR
    if ($_FILES["progressFile"]["error"] != 0 && $_FILES["progressFile"]["error"] != 4) {
        $fileError = true;
    }
    // IF NO FILE UPLOAD
    else if ($_FILES["progressFile"]["error"] == 4) {
        $filePath = NULL;
        $noFileInput = true;
    }
    // IF GOT FILE UPLOAD 
    // IF FILE SIZE TOO BIG 
    else if ($_FILES['progressFile']['size'] > $maxsize) {
        $fileErrorSize = true;
    }
    // IF FILE TYPE WRONG 
    else if ((!in_array($_FILES['progressFile']['type'], $acceptable)) && (!empty($_FILES['progressFile']["type"]))) {
        $fileErrorType = true;
    }

    // IF NO ERROR IN FILE, SET FILE PATH
    if (!$fileErrorSize && !$fileErrorType && !$fileError && !$noFileInput) {
        if (!file_exists('../localFolder/progress/')) {
            mkdir('../localFolder/progress/', 0777, true);
            $target_dir = "../localFolder/progress/";
            $filePath = $target_dir . $_FILES['progressFile']['name'];
        } else {
            $target_dir = "../localFolder/progress/";
            $filePath = $target_dir . $_FILES['progressFile']['name'];
        }
    }

    $conn = mysqli_connect("localhost", "root", "", "music_academy");

    if ($conn) {
        if ($fileErrorSize) {
            $response['title']  = 'Error practice progress file';
            $response['status']  = 'error';
            $response['message'] = 'File must not more than 500 Megabytes!';
        } else if ($fileErrorType) {
            $response['title']  = 'Error practice progress file';
            $response['status']  = 'error';
            $response['message'] = 'Invalid file type, please check again!';
        } else if ($fileError) {
            $response['title']  = 'Error practice progress file';
            $response['status']  = 'error';
            $response['message'] = 'File upload got error!';
        }

        // IF UPLOADED FILE NO ERROR OR NO FILE UPLOAD
        else {
            $sql = "INSERT INTO PRACTICE_PROGRESS (PROGRESS_ID,TEACHER_ID,CHILD_ID,PROGRESS_COURSE,PROGRESS_TITLE,PROGRESS_FILEPATH,PROGRESS_DATETIME) 
        VALUES ('','$userID','$child','$courseName','$title','$filePath',CURRENT_TIMESTAMP())";
            if ($filePath == NULL) {
                if (mysqli_query($conn, $sql)) {
                    $response['title']  = 'Done!';
                    $response['status']  = 'success';
                    $response['message'] = 'New practice progress added!';
                } else {
                    $response['title']  = 'Error!';
                    $response['status']  = 'error';
                    $response['message'] = 'mysql error';
                }
            } else {
                if (move_uploaded_file($_FILES['progressFile']['tmp_name'], $filePath) && mysqli_query($conn, $sql)) {
                    $response['title']  = 'Done!';
                    $response['status']  = 'success';
                    $response['message'] = 'New practice progress added!';
                } else {
                    $response['title']  = 'Error!';
                    $response['status']  = 'error';
                    $response['message'] = 'file move and mysql error';
                }
            }
        }
    } else {
        die("FATAL ERROR");
    }
    $conn->close();
}
echo json_encode($response);
