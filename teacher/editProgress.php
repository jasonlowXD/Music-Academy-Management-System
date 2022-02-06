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
    $progress_id = $_GET["progress_id"];
    $childProgress = $_POST['childProgress'];
    $progressTitle = $_POST['progressTitle'];
    $courseName = $_POST['courseName'];

    // THIS IS OLD FILE PATH
    if (!empty($_POST['oldFile'])) {
        $oldFile = $_POST['oldFile'];
        $filePath = $oldFile;
    } else {
        $oldFile = NULL;
    }

    $maxsize    = 524288000; // 500MB
    $acceptable = array(
        'video/mp4',
        'video/webm',
        'video/ogg',
        'video/mov',
        'video/wmv',
        'video/avi',
        'video/mpg',
        'video/mpeg'
    );

    // IF FILE UPLOAD BUT GOT ERROR
    if ($_FILES["progressFile"]["error"] != 0 && $_FILES["progressFile"]["error"] != 4) {
        $fileError = true;
    }
    // IF NO NEW FILE UPLOAD AND NO OLD FILE PATH, SET FILEPATH TO NULL
    else if ($_FILES["progressFile"]["error"] == 4) {
        if ($oldFile == null) {
            $filePath = null;
        }
        $noFileInput = true;
    }

    // IF FILE SIZE TOO BIG 
    else if ($_FILES['progressFile']['size'] > $maxsize) {
        $fileErrorSize = true;
    }
    // IF FILE TYPE WRONG 
    else if ((!in_array($_FILES['progressFile']['type'], $acceptable)) && (!empty($_FILES['progressFile']["type"]))) {
        $fileErrorType = true;
    }

    // IF NO ERROR IN NEW FILE, SET NEW FILE PATH
    if (!$fileErrorSize && !$fileErrorType && !$fileError && !$noFileInput) {
        $target_dir = "../localFolder/progress/";
        $filePath = $target_dir . $_FILES['progressFile']['name'];
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
        } // IF NEW UPLOADED FILE NO ERROR OR NO FILE UPLOAD
        else {

            $sql = "SELECT * FROM PRACTICE_PROGRESS WHERE PROGRESS_ID = '$progress_id' AND TEACHER_ID = '$userID'";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $db_child_id = $row["CHILD_ID"];
                $db_progress_title = $row["PROGRESS_TITLE"];
                $db_progress_filepath = $row["PROGRESS_FILEPATH"];
            }

            // IF NOTHING CHANGE
            if ($childProgress == $db_child_id && $progressTitle == $db_progress_title && $filePath ==  $db_progress_filepath) {
                $response['title']  = 'Nothing Changed!';
                $response['status']  = 'info';
                $response['message'] = 'All info are same!';
            }
            // IF GOT CHANGE
            else {
                $sql2 = "UPDATE PRACTICE_PROGRESS SET CHILD_ID ='$childProgress',PROGRESS_COURSE = '$courseName', PROGRESS_TITLE = '$progressTitle', PROGRESS_FILEPATH = '$filePath', PROGRESS_DATETIME = CURRENT_TIMESTAMP() WHERE PROGRESS_ID = '$progress_id' AND TEACHER_ID = '$userID'";

                // IF FILEPATH IS NULL OR FILEPATH SAME AS DATABASE FILEPATH 
                if ($filePath == NULL || $filePath == $db_progress_filepath) {
                    if (mysqli_query($conn, $sql2)) {
                        $response['title']  = 'Done!';
                        $response['status']  = 'success';
                        $response['message'] = 'Practice progress edited!';
                    } else {
                        $response['title']  = 'Error!';
                        $response['status']  = 'error';
                        $response['message'] = 'mysql error';
                    }
                }
                // IF IS NEW FILEPATH 
                else if ($filePath != $db_progress_filepath) {
                    if (move_uploaded_file($_FILES['progressFile']['tmp_name'], $filePath) && mysqli_query($conn, $sql2)) {
                        $response['title']  = 'Done!';
                        $response['status']  = 'success';
                        $response['message'] = 'Practice progress edited!';
                    } else {
                        $response['title']  = 'Error!';
                        $response['status']  = 'error';
                        $response['message'] = 'file move and mysql error';
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
