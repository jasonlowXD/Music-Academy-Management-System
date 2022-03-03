<?php
ob_get_contents();
ob_end_clean();

//IF THE POST FILE SIZE IS LARGER THAN POST_MAX_SIZE IN PHP.INI (CURRENTLY SET POST_MAX_SIZE AS 1000M ONLY)
if ($_SERVER["CONTENT_LENGTH"] > ((int)ini_get('post_max_size') * 1024 * 1024)) {
    // $num1 = $_SERVER["CONTENT_LENGTH"] ;
    // $num = ((int)ini_get('post_max_size')* 1024 * 1024);
    $response['title']  = 'Error resource file';
    $response['status']  = 'error';
    // $response['message'] = 'Too large jor la oiii '. $num1 .' more than '. $num.' already!';
    $response['message'] = 'File must not more than 2 megabytes!';
} else {
    $noFileInput = false;
    $fileError = false;
    $fileErrorSize = false;
    $fileErrorType = false;
    session_start();
    $response = array();
    $userID = $_SESSION["userID"];
    $resource_id = $_GET["resource_id"];
    $childResource = $_POST['childResource'];
    $resourceTitle = $_POST['resourceTitle'];
    if (!empty($_POST['resourceUrl'])) {
        $resourceUrl = $_POST['resourceUrl'];
    } else {
        $resourceUrl = NULL;
    }

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
    if ($_FILES["resourceFile"]["error"] != 0 && $_FILES["resourceFile"]["error"] != 4) {
        $fileError = true;
    }
    // IF NO NEW FILE UPLOAD AND NO OLD FILE PATH, SET FILEPATH TO NULL
    else if ($_FILES["resourceFile"]["error"] == 4) {
        if ($oldFile == null) {
            $filePath = null;
        }
        $noFileInput = true;
    }

    // IF FILE SIZE TOO BIG 
    else if ($_FILES['resourceFile']['size'] > $maxsize) {
        $fileErrorSize = true;
    }
    // IF FILE TYPE WRONG 
    else if ((!in_array($_FILES['resourceFile']['type'], $acceptable)) && (!empty($_FILES['resourceFile']["type"]))) {
        $fileErrorType = true;
    }

    // IF NO ERROR IN NEW FILE, SET NEW FILE PATH
    if (!$fileErrorSize && !$fileErrorType && !$fileError && !$noFileInput) {
        if (!file_exists('../localFolder/resource/')) {
            mkdir('../localFolder/resource/', 0777, true);
            $target_dir = "../localFolder/resource/";
            $filePath = $target_dir . $_FILES['resourceFile']['name'];
        } else {
            $target_dir = "../localFolder/resource/";
            $filePath = $target_dir . $_FILES['resourceFile']['name'];
        }
    }

    $conn = mysqli_connect("localhost", "root", "", "music_academy");
    if ($conn) {
        if ($fileErrorSize) {
            $response['title']  = 'Error resource file';
            $response['status']  = 'error';
            $response['message'] = 'File must not more than 2 megabytes!';
        } else if ($fileErrorType) {
            $response['title']  = 'Error resource file';
            $response['status']  = 'error';
            $response['message'] = 'Invalid file type, please check again!';
        } else if ($fileError) {
            $response['title']  = 'Error resource file';
            $response['status']  = 'error';
            $response['message'] = 'File upload got error!';
        } // IF NEW UPLOADED FILE NO ERROR OR NO FILE UPLOAD
        else {

            $sql = "SELECT * FROM LEARNING_RESOURCE WHERE RESOURCE_ID = '$resource_id' AND TEACHER_ID = '$userID'";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $db_child_id = $row["CHILD_ID"];
                $db_resource_title = $row["RESOURCE_TITLE"];
                $db_resource_url = $row["RESOURCE_URL"];
                $db_resource_filepath = $row["RESOURCE_FILEPATH"];
            }

            // IF NOTHING CHANGE
            if ($childResource == $db_child_id && $resourceTitle == $db_resource_title && $resourceUrl ==  $db_resource_url && $filePath ==  $db_resource_filepath) {
                $response['title']  = 'Nothing Changed!';
                $response['status']  = 'info';
                $response['message'] = 'All info are same!';
            }
            // IF GOT CHANGE
            else {
                $sql2 = "UPDATE LEARNING_RESOURCE SET CHILD_ID ='$childResource', RESOURCE_TITLE = '$resourceTitle', RESOURCE_URL = '$resourceUrl', RESOURCE_FILEPATH = '$filePath', RESOURCE_DATETIME = CURRENT_TIMESTAMP() WHERE RESOURCE_ID = '$resource_id' AND TEACHER_ID = '$userID'";

                // IF FILEPATH IS NULL OR FILEPATH SAME AS DATABASE FILEPATH 
                if ($filePath == NULL || $filePath == $db_resource_filepath) {
                    if (mysqli_query($conn, $sql2)) {
                        $response['title']  = 'Done!';
                        $response['status']  = 'success';
                        $response['message'] = 'Resource edited!';
                    } else {
                        $response['title']  = 'Error!';
                        $response['status']  = 'error';
                        $response['message'] = 'mysql error';
                    }
                }
                // IF IS NEW FILEPATH 
                else if ($filePath != $db_resource_filepath) {
                    if (move_uploaded_file($_FILES['resourceFile']['tmp_name'], $filePath) && mysqli_query($conn, $sql2)) {
                        $response['title']  = 'Done!';
                        $response['status']  = 'success';
                        $response['message'] = 'Resource edited!';
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
