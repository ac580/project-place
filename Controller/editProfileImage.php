<?php
include 'db.php';

if(!empty($_REQUEST['pic_id'])){
    
    $pic_id = $_REQUEST['pic_id'];
    if($pic_id){
        $q = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT ProfileImage FROM DatingClients WHERE ClientID='$pic_id'"));
        echo $q['ProfileImage'];
    }
}
?>