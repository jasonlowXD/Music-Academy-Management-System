<?php
session_start();
$flag = false;
$userID = $_SESSION["userID"];
$response = array();
$teacher_id = $_POST['teacher'];
$child_id = $_POST['child'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$day = $_POST['day'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$location = $_POST['location'];
$desc = $_POST['desc'];

$dayCode = '';
switch ($day) {
    case 'Sunday':
        $dayCode = '0';
        break;
    case 'Monday':
        $dayCode = '1';
        break;
    case 'Tuesday':
        $dayCode = '2';
        break;
    case 'Wednesday':
        $dayCode = '3';
        break;
    case 'Thrusday':
        $dayCode = '4';
        break;
    case 'Friday':
        $dayCode = '5';
        break;
    case 'Saturday':
        $dayCode = '6';
        break;
}

$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    // $response['message'] = $teacher_id . ',' . $child_id . ',' . $start_datetime . ',' . $end_datetime . ',' . $day . ',' . $location . ',' . $desc;
    $sql = "INSERT INTO CLASS_GROUP (CLASSGROUP_ID,ADMIN_ID,TEACHER_ID,CHILD_ID) 
    VALUES ('','$userID','$teacher_id','$child_id')";
    if (mysqli_query($conn, $sql)) {
        // GET THE CLASSGROUP ID FROM THE LAST INSERT QUERY
        $last_classgroup_id = mysqli_insert_id($conn);
        $currentdate = new DateTime($startDate);
        $interval = new DateInterval('P7D');
        $lastdate = new DateTime($endDate);
        while ($currentdate < $lastdate || $currentdate == $lastdate) {
            $date = $currentdate->format('Y-m-d');
            $start_datetime = $date . ' ' . $startTime . ':00';
            $end_datetime = $date . ' ' . $endTime . ':00';
            // $response['message'] = $last_classgroup_id . ',' . $start_datetime . ',' . $end_datetime . ',' . $dayCode . ',' . $location . ',' . $desc;

            $sql2 = "INSERT INTO CLASS (CLASS_ID,CLASSGROUP_ID,START_DATETIME,END_DATETIME,CLASS_DAY,CLASS_LOCATION,CLASS_DESC,ATTENDANCE) 
            VALUES ('','$last_classgroup_id','$start_datetime','$end_datetime','$dayCode','$location','$desc',NULL)";
            if (mysqli_query($conn, $sql2)) {
                $flag = true;
            } else {
                $flag = false;
                break;
            }
            $currentdate->add($interval);
        }
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'insert class_group error!';
    }

    if ($flag) {
        $response['title']  = 'Done!';
        $response['status']  = 'success';
        $response['message'] = 'Classes are successful added!';
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'insert class error!';
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
