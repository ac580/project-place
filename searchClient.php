<?php
session_start();

if (!isset($_SESSION['Username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Username']);
    header("location: login.php");
}
?>
<?
include 'Controller/db.php';
include 'menu.php';

if(isset($_GET['submitSearch'])) {
    
    
    
    $searchValueForName = $_GET['searchValueForName'];
    $searchValueForSex = $_GET['searchValueForSex'];
   $searchValueForSexualOrientation = $_GET['searchValueForSexualOrientation'];
    $searchValueForMaxAge = $_GET['searchValueForMaxAge'];
   
    $searchValueForName = preg_replace("#[^0-9a-z]#i"," ", $searchValueForName); //no chinese
    $lengthOfSearch = strlen($searchValueForName);
    
    
    $query = "SELECT * FROM DatingClients WHERE SUBSTR(ClientName,1,'$lengthOfSearch') LIKE '%$searchValueForName%' AND Sex='$searchValueForSex' AND SexualOrientation='$searchValueForSexualOrientation' AND 
Age < $searchValueForMaxAge ORDER BY Age DESC";
   
    //search for age and name and sex
    if($searchValueForSexualOrientation==""){
        
        $query = "SELECT * FROM DatingClients WHERE SUBSTR(ClientName,1,'$lengthOfSearch') LIKE '%$searchValueForName%' AND Sex='$searchValueForSex' AND Age<$searchValueForMaxAge ORDER BY Age DESC";
        
    }
    
    
    //search for age and name and sexual orientation
    if($searchValueForSex==""){
        
        $query = "SELECT * FROM DatingClients WHERE SUBSTR(ClientName,1,'$lengthOfSearch') LIKE '%$searchValueForName%' AND SexualOrientation='$searchValueForSexualOrientation' AND Age<$searchValueForMaxAge ORDER BY Age DESC";
        
    }
    //search for sex and name and sexual orientation
    if($searchValueForMaxAge==""){
        
        $query = "SELECT * FROM DatingClients WHERE SUBSTR(ClientName,1,'$lengthOfSearch') LIKE '%$searchValueForName%' AND SexualOrientation='$searchValueForSexualOrientation' AND Sex='$searchValueForSex'";
        
    }
    //search for age and sex and sexual orientation
    if($searchValueForName==""){
        
        $query = "SELECT * FROM DatingClients WHERE Age<$searchValueForMaxAge AND SexualOrientation='$searchValueForSexualOrientation' AND Sex='$searchValueForSex' ORDER BY Age DESC";
        
    }
    
    
    if($searchValueForSex=="" && $searchValueForMaxAge==""){ //search for name and sexual orientation
        $query = "SELECT * FROM DatingClients WHERE SUBSTR(ClientName,1,'$lengthOfSearch') LIKE '%$searchValueForName%' AND SexualOrientation='$searchValueForSexualOrientation'";
    
    }
    
    if($searchValueForName=="" && $searchValueForMaxAge==""){ //search for sex and sexual orientation
        
        $query = "SELECT * FROM DatingClients WHERE Sex='$searchValueForSex' AND SexualOrientation='$searchValueForSexualOrientation'";
        
    }
    
    if($searchValueForSexualOrientation=="" && $searchValueForMaxAge==""){ //search for sex and name
        
        $query = "SELECT * FROM DatingClients WHERE SUBSTR(ClientName,1,'$lengthOfSearch') LIKE '%$searchValueForName%' AND Sex='$searchValueForSex'";
        
    }
    
    
    //search for age and name
    if($searchValueForSexualOrientation=="" && $searchValueForSex==""){ 
        
        $query = "SELECT * FROM DatingClients WHERE SUBSTR(ClientName,1,'$lengthOfSearch') LIKE '%$searchValueForName%' AND Age<$searchValueForMaxAge ORDER BY Age DESC";
        
    }
    
    //search for sex and age
    if($searchValueForName=="" && $searchValueForSexualOrientation==""){ 
        
        $query = "SELECT * FROM DatingClients WHERE Sex='$searchValueForSex' AND Age<$searchValueForMaxAge ORDER BY Age DESC";
        
    }
    
    
    //search for sexual orientation and age
    if($searchValueForName=="" && $searchValueForSex==""){
        
        $query = "SELECT * FROM DatingClients WHERE SexualOrientation='$searchValueForSexualOrientation' AND Age<$searchValueForMaxAge ORDER BY Age DESC";
        
    }
    
    
    if($searchValueForSex=="" && $searchValueForSexualOrientation=="" && $searchValueForMaxAge==""){ //search for name
         
        $query = "SELECT * FROM DatingClients WHERE SUBSTR(ClientName,1,'$lengthOfSearch') LIKE '%$searchValueForName%'";
    }
    
    if($searchValueForName=="" && $searchValueForSexualOrientation=="" && $searchValueForMaxAge==""){ //search for sex
        
        $query = "SELECT * FROM DatingClients WHERE Sex='$searchValueForSex'";
    }
    
    if($searchValueForName=="" && $searchValueForSex=="" && $searchValueForMaxAge==""){ //search for sexual orientation
        $query = "SELECT * FROM DatingClients WHERE SexualOrientation='$searchValueForSexualOrientation'";
    }
    
    if($searchValueForName=="" && $searchValueForSex=="" && $searchValueForSexualOrientation==""){ //search for age
        $query = "SELECT * FROM DatingClients WHERE Age < $searchValueForMaxAge ORDER BY Age DESC";
    }
    
    if($searchValueForName=="" && $searchValueForSex=="" && $searchValueForSexualOrientation=="" && $searchValueForMaxAge==""){ //search nothing
        $query = "SELECT * FROM DatingClients";
    }
    
    
    
    
    
    $searchResult = searchResultTable($query);
    
   
    
}
else{
    
    $query = "SELECT * FROM DatingClients";
    $searchResult = searchResultTable($query);
    
}

if(isset($_POST['cancelSearch'])) {
    
    $query = "SELECT * FROM DatingClients";
    $searchResult = searchResultTable($query);
    
}







function searchResultTable($query){
    //$connect = mysqli_connect("127.0.0.1", "root", "", "xampp");
    $connect = mysqli_connect('sql8.freemysqlhosting.net:3306','sql8170829','SlPlzHaDzE','sql8170829');
    
    mysqli_set_charset($connect,'utf8');
    
    
    
    $fetchResult=mysqli_query($connect,"SET collation_connection = 'utf8'");
    $fetchResult= mysqli_query($connect,$query);
    
   
  
  
        

    return $fetchResult;
    
    
    
    }



?>






<!DOCTYPE html>
<html>
	<head>
	<link rel="shortcut icon" href="logo/favicon.ico">
		<title>社區上的可約人</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style>
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:1270px;
				padding:20px;
				background-color:#FFF933;
				color:#2F85A5;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
		<div class="container box">
			<h2 align="center">社區上的可約人一覽</h2>
		
				
				 <form action="searchClient.php" method="get" style="width: 1100px" >
				<input type="text" name="searchValueForName" placeholder="名稱" value="<?php echo $searchValueForName; ?>"/>
				
				<input type="hidden" name="searchValueForSex" value="<?php echo $searchValueForSex; ?>"/>
			<?php $svalue = $searchValueForSex?>
			<select name="searchValueForSex">
			<option value="" <?php if($svalue=="") echo 'selected="selected"'; ?> >姓別</option>
			<option value="男" <?php if($svalue=="男") echo 'selected="selected"'; ?> >男</option>
			<option value="女" <?php if($svalue=="女") echo 'selected="selected"'; ?> >女</option>
			</select>
				
				
				<input type="hidden" name="searchValueForSexualOrientation" value="<?php echo $searchValueForSexualOrientation; ?>"/>
			<?php $svalue = $searchValueForSexualOrientation?>
			<select name="searchValueForSexualOrientation">
			<option value="" <?php if($svalue=="") echo 'selected="selected"'; ?> >性取向</option>
			<option value="異性" <?php if($svalue=="男") echo 'selected="selected"'; ?> >異性</option>
			<option value="同性" <?php if($svalue=="男") echo 'selected="selected"'; ?> >同性</option>
			<option value="雙性" <?php if($svalue=="女") echo 'selected="selected"'; ?> >雙性</option>
			</select>
			
			
			
			
				<input type="text" name="searchValueForMaxAge" placeholder="年齡上限" value="<?php echo $searchValueForMaxAge; ?>"/>
				
				<br/><br/>
				 <input type="submit" name="submitSearch" class="btn" value="搜尋">
				 <input type="submit" name="cancelSearch" class="btn" value="取消">
				 <br/><br/>
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="15%">頭像</th>
							<th width="10%">姓名</th>
							<th width="10%">姓別</th>
							<th width="10%">年齡</th>
							<th width="15%">國藉</th>
							<th width="10%">性取向</th>
							<th width="15%">查看完整資料</th>
						
						
						</tr>
						<?php 
						 
						
						
						$Username = $_SESSION['Username'];
						
						
						/*$q = mysqli_query($dbc, "SELECT * FROM DatingClients");
						error_reporting(0);
						$r = mysqli_query($dbc, $q);*/
						
						
						
						
						while($r = mysqli_fetch_array($searchResult)){
						   
					 ?>
					 
					 <tr>
					 <td><img src="Controller/getProfileImage.php?pic_id=<?php echo $r['ClientID']; ?>" width="140px" height="110px" alt=""></td>
					 <td><?php echo $r['ClientName'];?></td>
					 <td><?php echo $r['Sex'];?></td>
					 <td><?php echo $r['Age'];?></td>
					 <td><?php echo $r['Nationality'];?></td>
					 <td><?php echo $r['SexualOrientation'];?></td>
					 <td><a href="viewFullClient.php?viewFullClient=<?php echo $r['ClientID'] ?>">查看完整資料</a></td>
					 </tr>
					 <?php
					 }
					 ?>
						
					</thead>
				</table>
				</form>
				
				
			</div>
		
	</body>
</html>



