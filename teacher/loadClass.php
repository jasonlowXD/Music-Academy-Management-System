<?php
session_start();
$userID = $_SESSION["userID"];
$response = array();
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "SELECT CLASS_GROUP.CLASSGROUP_ID, 
    CLASS.CLASS_ID, CLASS.START_DATETIME,CLASS.END_DATETIME, CLASS.CLASS_LOCATION, CLASS.CLASS_DESC, CLASS.ATTENDANCE,
    CHILD.CHILD_NAME, COURSE.COURSE_NAME, COURSE.DURATION_PER_CLASS
                FROM CLASS_GROUP 
                LEFT JOIN CLASS ON CLASS_GROUP.CLASSGROUP_ID = CLASS.CLASSGROUP_ID 
                LEFT JOIN CHILD ON CLASS_GROUP.CHILD_ID = CHILD.CHILD_ID
                LEFT JOIN COURSE ON CHILD.COURSE_ID = COURSE.COURSE_ID
                WHERE CLASS_GROUP.TEACHER_ID = '$userID'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {

        $classID = $row["CLASS_ID"];
        $courseName = $row["COURSE_NAME"];
        $childName = $row["CHILD_NAME"];
        $title = $childName . ',' . $courseName;

        $startDatetime = $row["START_DATETIME"];
        $startDatetime = preg_replace('/\s+/u', 'T', $startDatetime);

        $endDatetime = $row["END_DATETIME"];
        $endDatetime = preg_replace('/\s+/u', 'T', $endDatetime);

        $duration = $row["DURATION_PER_CLASS"];

        $extendedProps = array();
        $extendedProps[] = array(
            'classGroup' => $row["CLASSGROUP_ID"],
            'location' => $row["CLASS_LOCATION"],
            'description' => $row["CLASS_DESC"],
            'attendance' => $row["ATTENDANCE"],
            'duration' =>   $duration,
        );

        if ($row["ATTENDANCE"] == null) {
            $className = 'bg-primary';
        } else if ($row["ATTENDANCE"] == 'absent') {
            $className = 'bg-danger';
        } else if ($row["ATTENDANCE"] == 'present') {
            $className = 'bg-success';
        }

        $sql2 = "SELECT * FROM RESCHEDULE_REQUEST WHERE CLASS_ID = '$classID' ORDER BY REQUEST_ID DESC LIMIT 1";
        $result2 = $conn->query($sql2);
        while ($row2 = $result2->fetch_assoc()) {
            if ($row2["REQUEST_STATUS"] == 'pending') {
                $className = 'bg-warning';
            }
        }

        $response[] = array(
            'id' => $classID,
            'title' =>  $title,
            'start' =>  $startDatetime,
            'end' =>  $endDatetime,
            'className' =>   $className,
            'extendedProps' =>  $extendedProps,
        );
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
