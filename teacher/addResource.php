<?php
$noFileInput = false;
$fileError = false;
$fileErrorSize = false;
$fileErrorType = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$child = $_POST['child'];
$title = $_POST['title'];

if (!empty($_POST['url'])) {
    $url = $_POST['url'];
} else {
    $url = NULL;
}

// $temp_name  = $_FILES['resourceFile']['error'];
// $response['title']  = 'check';
// $response['status']  = 'error';
// $response['message'] = strval($temp_name);


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
// IF NO FILE UPLOAD
else if ($_FILES["resourceFile"]["error"] == 4) {
    $filePath = NULL;
    $noFileInput = true;
}
// IF GOT FILE UPLOAD 
// IF FILE SIZE TOO BIG 
else if ($_FILES['resourceFile']['size'] > $maxsize) {
    $fileErrorSize = true;
}
// IF FILE TYPE WRONG 
else if ((!in_array($_FILES['resourceFile']['type'], $acceptable)) && (!empty($_FILES['resourceFile']["type"]))) {
    $fileErrorType = true;
}

// IF NO ERROR IN FILE, SET FILE PATH
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
    }

    // IF UPLOADED FILE NO ERROR OR NO FILE UPLOAD
    else {
        $sql = "INSERT INTO LEARNING_RESOURCE (RESOURCE_ID,TEACHER_ID,CHILD_ID,RESOURCE_TITLE,RESOURCE_URL,RESOURCE_FILEPATH,RESOURCE_DATETIME) 
        VALUES ('','$userID','$child','$title','$url','$filePath',CURRENT_TIMESTAMP())";
        if ($filePath == NULL) {
            if (mysqli_query($conn, $sql)) {
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'New resource added!';
            } else {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'mysql error';
            }
        } else {
            if (move_uploaded_file($_FILES['resourceFile']['tmp_name'], $filePath) && mysqli_query($conn, $sql)) {
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'New resource added!';
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
echo json_encode($response);
