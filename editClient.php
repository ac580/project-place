<?php

include 'Controller/db.php';
include 'Controller/server.php';

if(isset($_GET['editClient'])){
    
    $ClientID = $_GET['editClient'];
    
    $res = mysqli_query($dbc,"SELECT * FROM DatingClients WHERE ClientID='$ClientID'");
    $row = mysqli_fetch_array($res);
    
}



if(isset($_POST['updateImage']))
{
    
    if ($_FILES['image']['size'] != 0 ) {
        
        $filename = mysqli_real_escape_string($dbc,$_FILES['image']['name']);
        $filedata= mysqli_real_escape_string($dbc,file_get_contents($_FILES['image']['tmp_name']));
        $filetype = mysqli_real_escape_string($dbc,$_FILES['image']['type']);
        $filesize = intval($_FILES['image']['size']);
        
        $q = mysqli_query($dbc, "UPDATE DatingClients SET ProfileImage='$filedata'  WHERE ClientID='$ClientID'");
        $r = mysqli_query($dbc, $q);
        
    }
}


include 'menu.php';


?>

<!DOCTYPE html>
<html>
	<head>
	<link rel="shortcut icon" href="logo/favicon.ico">
		<title>更改可約人資料</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script>
$(document).ready(function(){


    $("#fileChosen").click(function(){
        $("#submit").toggle();
    });
});
</script>
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
	
	<div class="header">
		<h1>更改可約人資料</h1>
		<p>*必填</p>
	</div>
	
	
	<form method="POST" enctype="multipart/form-data">
<input type="hidden" name = "ClientID" value="<?php echo $ClientID ?>">

<div class="input-group">
<label>上載頭像</label>
<br/>
<img src="Controller/getProfileImage.php?pic_id=<?php echo $ClientID; ?>" width="200px" height="200px" alt="">
<br/><br/>
<input type="file" name="image" id="fileChosen" class="btn">
<br/>
<input type="submit" name="updateImage" value="更換頭像" class="btn" id="submit" style="display:none;">

</div>
</form>

	
		<form action="editClient.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name = "ClientID" value="<?php echo $ClientID ?>">

	
		<div class="input-group">
		<br/>
			<label>姓名 *</label>
			<input type="text" name="ClientName" value="<?php echo $row['ClientName']; ?>"/>
		</div>
		<div class="input-group">
			<label>姓別</label>
			
			<input type="hidden" name="Sex" value="<?php echo $row['Sex']; ?>"/>
			<?php $svalue = $row['Sex']?>
	
			<select name="Sex">
			<option value="男" <?php if($svalue=="男") echo 'selected="selected"'; ?> >男</option>
			<option value="女" <?php if($svalue=="女") echo 'selected="selected"'; ?> >女</option>
			</select>

		</div>
		<div class="input-group">
			<label>年齡 *</label>
			<input type="number" name="Age" value="<?php echo $row['Age']; ?>">
		</div>
		<div class="input-group">
			<label>身高 (厘米)</label>
			<input type="number" name="Height" value="<?php echo $row['Height']; ?>">
		</div>
		<div class="input-group">
			<label>上圍 (尺寸)</label>
			<input type="number" name="Chest" value="<?php echo $row['Chest']; ?>">
		</div>
		<div class="input-group">
			<label>腰圍 (尺寸)</label>
			<input type="number" name="Wrist" value="<?php echo $row['Wrist']; ?>">
		</div>
		<div class="input-group">
			<label>臀圍 (尺寸)</label>
			<input type="number" name="Hips" value="<?php echo $row['Hips']; ?>">
		</div>
		<div class="input-group">
			<label>國藉</label>
			
			<input type="hidden" name="Nationality" value="<?php echo $row['Nationality']; ?>"/>
			<?php $nvalue = $row['Nationality']?>
			<select name="Nationality">
			
			<option value="香港"<?php if($nvalue=="香港") echo 'selected="selected"'; ?>>香港</option>
			<option value="澳門"<?php if($nvalue=="澳門") echo 'selected="selected"'; ?>>澳門</option>
			<option value="台灣"<?php if($nvalue=="台灣") echo 'selected="selected"'; ?>>台灣</option>
			<option value="中國大陸"<?php if($nvalue=="中國大陸") echo 'selected="selected"'; ?>>中國大陸</option>
			<option value="英國"<?php if($nvalue=="英國") echo 'selected="selected"'; ?>>英國</option>
			<option value="美國"<?php if($nvalue=="美國") echo 'selected="selected"'; ?>>美國</option>
			<option value="加拿大"<?php if($nvalue=="加拿大") echo 'selected="selected"'; ?>>加拿大</option>
			<option value="澳洲"<?php if($nvalue=="澳洲") echo 'selected="selected"'; ?>>澳洲</option>
			<option value="紐西蘭"<?php if($nvalue=="紐西蘭") echo 'selected="selected"'; ?>>紐西蘭</option>
			<option value="其他"<?php if($nvalue=="其他") echo 'selected="selected"'; ?>>其他</option>
			<option value="不便透露"<?php if($nvalue=="不便透露") echo 'selected="selected"'; ?>>不便透露</option>
			</select>
		</div>
		<div class="input-group">
			<label>教育程度</label>
			<input type="hidden" name="Education" value="<?php echo $row['Education']; ?>"/>
			<?php $evalue = $row['Education']?>
			<select name="Education">
			
			<option value="小學或以下"<?php if($evalue=="小學或以下") echo 'selected="selected"'; ?>>小學或以下</option>
			<option value="中學"<?php if($evalue=="中學") echo 'selected="selected"'; ?>>中學</option>
			<option value="文憑或證書"<?php if($evalue=="文憑或證書") echo 'selected="selected"'; ?>>文憑／證書</option>
			<option value="副學士"<?php if($evalue=="副學士") echo 'selected="selected"'; ?>>副學士</option>
			<option value="學士"<?php if($evalue=="學士") echo 'selected="selected"'; ?>>學士</option>
			<option value="碩士"<?php if($evalue=="碩士") echo 'selected="selected"'; ?>>碩士</option>
			<option value="博士或以上"<?php if($evalue=="博士或以上") echo 'selected="selected"'; ?>>博士或以上</option>
			<option value="不便透露"<?php if($evalue=="不便透露") echo 'selected="selected"'; ?>>不便透露</option>
			</select>
		</div>
		
		<div class="input-group">
			<label>職業</label>
			<input type="text" name="Occupation" value="<?php echo $row['Occupation']; ?>">
		</div>
		<div class="input-group">
			<label>興趣</label><br/>
			<textarea name = "Hobbies" cols=30  rows=3><?php echo $row['Hobbies'] ?></textarea>
		</div>
		<div class="input-group">
			<label>理想約會地點</label>
			<input type="hidden" name="Location" value="<?php echo $row['Location']; ?>"/>
			<?php $lvalue = $row['Location']?>
			<select name="Location">
			<option value="港島"<?php if($lvalue=="港島") echo 'selected="selected"'; ?>>港島</option>
			<option value="九龍"<?php if($lvalue=="九龍") echo 'selected="selected"'; ?>>九龍</option>
			<option value="新界"<?php if($lvalue=="新界") echo 'selected="selected"'; ?>>新界</option>
			<option value="離島"<?php if($lvalue=="離島") echo 'selected="selected"'; ?>>離島</option>
			<option value="其他"<?php if($lvalue=="其他") echo 'selected="selected"'; ?>>其他</option>
			</select>
		
		</div>
		<div class="input-group">
			<label>性取向</label>
			<input type="hidden" name="SexualOrientation" value="<?php echo $row['SexualOrientation']; ?>"/>
			<?php $svalue = $row['SexualOrientation']?>
			<select name="SexualOrientation">
			<option value="異性"<?php if($svalue=="異性") echo 'selected="selected"'; ?>>異性</option>
			<option value="同性"<?php if($svalue=="同性") echo 'selected="selected"'; ?>>同性</option>
			<option value="雙性"<?php if($svalue=="雙性") echo 'selected="selected"'; ?>>雙性</option>
			</select>
		</div>
		<div class="input-group">
			<label>更多資料</label><br/>
			<textarea name = "OtherInfo" cols=30  rows=3><?php echo $row['OtherInfo'] ?></textarea>
		</div>
		
		
		<div class="input-group">
			<button type="submit" class="btn" name="updateClient">確定</button>
		</div>
		</form>
	
	</body>
	
	</html>
	




