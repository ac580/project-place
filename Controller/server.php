<?php 

session_start();

// variable declaration
$Username = "";
$UserEmail = "";
$UserContactNumber  = "";
$errors = array(); 
$_SESSION['success'] = "";



include 'db.php';

// REGISTER USER
if (isset($_POST['createNewUser'])) {
	// receive all input values from the form
	$Username = mysqli_real_escape_string($dbc, $_POST['Username']);
	$UserEmail = mysqli_real_escape_string($dbc, $_POST['UserEmail']);
	$UserContactNumber = mysqli_real_escape_string($dbc, $_POST['UserContactNumber']);
	$SetPassword = mysqli_real_escape_string($dbc, $_POST['SetPassword']);
	$ConfirmPassword = mysqli_real_escape_string($dbc, $_POST['ConfirmPassword']);

	// form validation: ensure that the form is correctly filled
	if (empty($Username)) { array_push($errors, "請輸入密碼"); }
	if (empty($UserEmail)) { array_push($errors, "請輸入電郵"); }
	if (empty($UserContactNumber)) { array_push($errors, "請輸入聯絡密碼"); }
	if (empty($SetPassword)) { array_push($errors, "請輸入密碼"); }

	if ($SetPassword != $ConfirmPassword) {
		array_push($errors, "請確定輸入兩組一致密碼");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$UserPassword = md5($SetPassword);//encrypt the password before saving in the database
		$query = "INSERT INTO DatingUsers (Username, UserPassword, UserEmail, UserContactNumber,UserRole) 
				  VALUES('$Username', '$UserPassword', '$UserEmail', '$UserContactNumber','User')";
		mysqli_query($dbc, $query);

		$_SESSION['Username'] = $Username;
		$_SESSION['success'] = "你已成功申請此帳戶";
		header('location: ../home.php');
	}

}


// LOGIN USER
if (isset($_POST['loginUser'])) {
    $Username = mysqli_real_escape_string($dbc, $_POST['Username']);
    $UserPassword = mysqli_real_escape_string($dbc, $_POST['UserPassword']);
    
    if (empty($Username)) {
        array_push($errors, "請輸入帳戶名稱");
    }
    if (empty($UserPassword)) {
        array_push($errors, "請輸入密碼");
    }
    
    if (count($errors) == 0) {
        $UserPassword = md5($UserPassword);
        $query = "SELECT * FROM DatingUsers WHERE Username='$Username' AND UserPassword='$UserPassword'";
        $results = mysqli_query($dbc, $query);
        
        error_reporting(0);
        if (mysqli_num_rows($results) == 1) {
            
            //CHECK USER OR ADMIN 
            $login = mysqli_fetch_assoc($results);
            if($login['UserRole']=='Admin'){
            $_SESSION['Username'] = $Username;
 
            $_SESSION['success'] = "你成功已管理員身份登入";
      
            header('location: ../adminHome.php');
        }
        
        else {
            $_SESSION['Username'] = $Username;
      
            $_SESSION['success'] = "你成功已會員身份登入";
            header('location: ../home.php');
        }
        
        
        }else{
            error_reporting(0);
            array_push($errors, "帳戶名稱／密碼錯誤");
        }
    
}
}





// ADD CLIENT
if (isset($_POST['createNewClient'])) {
    // receive all input values from the form
    $ClientName = mysqli_real_escape_string($dbc, $_POST['ClientName']);
    $Sex = mysqli_real_escape_string($dbc, $_POST['Sex']);
    $Age = mysqli_real_escape_string($dbc, $_POST['Age']);
    $Height = mysqli_real_escape_string($dbc, $_POST['Height']);
    $Chest = mysqli_real_escape_string($dbc, $_POST['Chest']);
    $Wrist = mysqli_real_escape_string($dbc, $_POST['Wrist']);
    $Hips = mysqli_real_escape_string($dbc, $_POST['Hips']);
    $Nationality = mysqli_real_escape_string($dbc, $_POST['Nationality']);
    $Education = mysqli_real_escape_string($dbc, $_POST['Education']);
    $Occupation = mysqli_real_escape_string($dbc, $_POST['Occupation']);
    $Hobbies = mysqli_real_escape_string($dbc, $_POST['Hobbies']);
    $Location = mysqli_real_escape_string($dbc, $_POST['Location']);
    $SexualOrientation = mysqli_real_escape_string($dbc, $_POST['SexualOrientation']);
    $OtherInfo = mysqli_real_escape_string($dbc, $_POST['OtherInfo']);
    $Username = mysqli_real_escape_string($dbc, $_POST['Username']);
    
    
    //add profile picture
    $filename=$_FILES['image']['name'];
    $tmpname=$_FILES['image']['tmp_name'];
    $filetype=$_FILES['image']['type'];
    $filesize=$_FILES['image']['size'];
    $file=NULL;
   
    
    
    // form validation: ensure that the form is correctly filled
    if (empty($ClientName)) { array_push($errors, "請輸入可約人的姓名"); }
    if (empty($filename or $tmpname or $filetype)) { array_push($errors, "請上載可約人的頭像"); }
    if ($Sex=="") { array_push($errors, "請替可約人選擇姓別"); }
    if ($Age=="") { array_push($errors, "請輸入可約人年齡"); }
    if ($Location=="") { array_push($errors, "請替可約人選擇約會地點"); }

    
    // add client if there are no errors in the form
   
        if (count($errors) == 0) {
            
            if(isset($_FILES['image']['error'])){
                if($_FILES['image']['error']==0){
                    $instr = fopen($tmpname,"rb" );
                    $file = addslashes(fread($instr,filesize($tmpname)));
                }
            }
            $instr = fopen($tmpname,"rb" );
            $file = addslashes(fread($instr,filesize($tmpname)));
            $shortArgument = "'".$file."'";
            
            
            
            $query = "INSERT INTO DatingClients (ProfileImage,ClientName, Sex, Age, Height,Chest,Wrist,Hips,
Nationality,Education,Occupation,Hobbies,Location,SexualOrientation,OtherInfo,Username)
				  VALUES($shortArgument,'$ClientName', '$Sex', '$Age', '$Height','$Chest','$Wrist','$Hips',
'$Nationality','$Education','$Occupation','$Hobbies','$Location','$SexualOrientation','$OtherInfo','$Username')";
        
   
    
    mysqli_query($dbc, $query);
    mysqli_close($dbc);
    
        
       $_SESSION['success'] = "你已成功新增一個可約的人";
       //$_SESSION['success'] = "'$Username','$ClientID'";
        header('location: ../home.php');
    }
    
}


// UPDATE CLIENT
if (isset($_POST['updateClient'])) {
    // receive all input values from the form
    $ClientName = mysqli_real_escape_string($dbc, $_POST['ClientName']);
    $Sex = mysqli_real_escape_string($dbc, $_POST['Sex']);
    $Age = mysqli_real_escape_string($dbc, $_POST['Age']);
    $Height = mysqli_real_escape_string($dbc, $_POST['Height']);
    $Chest = mysqli_real_escape_string($dbc, $_POST['Chest']);
    $Wrist = mysqli_real_escape_string($dbc, $_POST['Wrist']);
    $Hips = mysqli_real_escape_string($dbc, $_POST['Hips']);
    $Nationality = mysqli_real_escape_string($dbc, $_POST['Nationality']);
    $Education = mysqli_real_escape_string($dbc, $_POST['Education']);
    $Occupation = mysqli_real_escape_string($dbc, $_POST['Occupation']);
    $Hobbies = mysqli_real_escape_string($dbc, $_POST['Hobbies']);
    $Location = mysqli_real_escape_string($dbc, $_POST['Location']);
    $SexualOrientation = mysqli_real_escape_string($dbc, $_POST['SexualOrientation']);
    $OtherInfo = mysqli_real_escape_string($dbc, $_POST['OtherInfo']);
    $ClientID = mysqli_real_escape_string($dbc, $_POST['ClientID']);
    
    // form validation: ensure that the form is correctly filled
    
    if (strlen((string)$ClientName)<14) { array_push($errors, "請輸入可約人的姓名"); }
    if ($Age<18) { array_push($errors, "請輸入可約人年齡"); }
    
    
    
    
    $query = "UPDATE DatingClients SET ClientName ='$ClientName',
            Sex='$Sex',
            Age=$Age,
            Height=$Height,
            Chest=$Chest,
            Wrist=$Wrist,
            Hips=$Hips,
            Nationality='$Nationality',
            Education='$Education',
            Occupation='$Occupation',
            Hobbies='$Hobbies',
            Location='$Location',
            SexualOrientation='$SexualOrientation',
            OtherInfo='$OtherInfo' WHERE ClientID=$ClientID";
    
    
    mysqli_query($dbc,$query) or die("Could not update".mysql_error());
    mysqli_close($dbc);
    header('location: ../clientList.php');
}





// SEND NOTIFICATION
if (isset($_POST['sendNotification'])) {
    // receive all input values from the form
    $ClientName = mysqli_real_escape_string($dbc, $_POST['ClientName']);
    $ClientID = mysqli_real_escape_string($dbc, $_POST['ClientID']);
    $Username = mysqli_real_escape_string($dbc, $_POST['Username']);
    $Comments = mysqli_real_escape_string($dbc, $_POST['Comments']);
    
    
    $SenderUsername = $_SESSION['Username'];
   
    
    $query = "SELECT * FROM DatingUsers WHERE Username='$SenderUsername'";
        
       
        
       
        if(mysqli_query($dbc, $query)){
            $row = mysqli_fetch_array(mysqli_query($dbc, $query));
        
            $SenderEmail = $row['UserEmail'];
            $SenderContactNumber = $row['UserContactNumber'];
            
        
            
            $query = "INSERT INTO DatingNotifications (ClientName,ClientID,ClientUsername,SenderUsername,SenderEmail,SenderContactNumber,Comments)
				  VALUES('$ClientName', $ClientID, '$Username','$SenderUsername','$SenderEmail','$SenderContactNumber','$Comments')";
        
        
            if(mysqli_multi_query($dbc, $query)){
                $_SESSION['success'] = "你已成功發送邀請";
                header('location: ../home.php');
                mysqli_close($dbc);
            }else{ 
                 echo "failed";
            }
            
        }
                
    
}



?>


