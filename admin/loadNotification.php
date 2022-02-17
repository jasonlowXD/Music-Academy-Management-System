<?php
session_start();
$output = '';
$response = array();
$response['unseen'] = 'false';
$userID = $_SESSION["userID"];
$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "SELECT * FROM NOTIFICATION WHERE ADMIN_ID = '$userID' ORDER BY DATETIME DESC";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $output = '<a href="javascript:void(0)"> <div class=""><h5>No notification</h5></div></a>';
    } else {
        while ($row = $result->fetch_assoc()) {
            $notificationID = $row["NOTIFICATION_ID"];
            $title = $row["TITLE"];
            $content = $row["CONTENT"];
            $status = $row["VIEW_STATUS"];
            $datetime = date_create($row["DATETIME"]);
            $datetime_display = date_format($datetime, 'Y-m-d g:ia');
            $link = $row["LINK"];

            // if notification is unseen 
            if ($status == "unseen") {
                $response['unseen']  = 'true';
                $output .= '<a href="' . $link . '" onClick="updateNotification(' . $notificationID . ')">
                                <div class="">
                                    <h5 class=" font-weight-bold">' . $title . '</h5>
                                    <p class="text-dark"><strong>' . $content . '</strong></p>
                                    <span class="text-info">' . $datetime_display . '</span>
                                </div>
                            </a>';
            } else if ($status == "seen") {
                $output .= ' <a href="' . $link . '">
                                <div class="">
                                    <h5 class=" ">' . $title . '</h5>
                                    <p class=" text-muted">' . $content . '</p>
                                    <span class="text-muted">' . $datetime_display . '</span>
                                </div>
                            </a>';
            }
        }
    }
} else {
    die("FATAL ERROR");
}

$response['notification']  =  $output;
$conn->close();
echo json_encode($response);
