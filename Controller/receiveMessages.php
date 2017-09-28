
<?php

include 'db.php';


$NotificationID = $_REQUEST['id'];


$result1 = mysqli_query($dbc,"SELECT * FROM DatingMessages WHERE NotificationID=$NotificationID");

while($extract = mysqli_fetch_array($result1)) {
    echo "<span>" . $extract['MessagesSenderName'] . "</span>: <span>" . $extract['Messages'] . "</span><br />";
}

?>