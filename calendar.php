<?
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
include 'menu.php';


?>


<?php
require_once('Controller/bdd.php');

$Username = $_SESSION['Username'];


$sql = "SELECT id, title, start, end, color FROM events WHERE Username = '$Username'";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>您的日程</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />
	<link rel="stylesheet" type="text/css" href="style.css">


    <!-- Custom CSS -->
    <style>

	#calendar {
		max-width: 800px;
		max-height: 800px;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
	.form-group{
	width: 400px;
	}
	
	.form-horizontal{
	width: 750px;
	}
	
		
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:1000px;
				padding:20px;
				background-color:#FFF933;
				color:#2F85A5;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
	
	
	
	
	
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Page Content -->
    <div class="container box">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>您的日程</h1>
          
                <div id="calendar" class="col-centered">
                </div>
            </div>
			
        </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="Controller/addEvent.php">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">添加日程</h4>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">標題</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="請輸入">
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">顏色</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
						  <option value="">請選擇</option>
						  <option style="color:#FF0000;" value="#FF0000">紅色</option>
						   <option style="color:#FF8C00;" value="#FF8C00">橙色</option>
						   <option style="color:#FFD700;" value="#FFD700">黃色</option>
						    <option style="color:#1BCD64;" value="#1BCD64">綠色</option>
						  <option style="color:#008000;" value="#008000">藍色</option>	
						   <option style="color:#C51BCD;" value="#C51BCD">紫色</option>							  
						 
						  
						</select>
					</div>
				  </div>
				  <div class="form-group">
					
					<div class="col-sm-10">
					  <input type="hidden" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>
				  <div class="form-group">

					<div class="col-sm-10">
					  <input type="hidden" name="end" class="form-control" id="end" readonly>
					</div>
				  </div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				<button type="submit" class="btn btn-primary">確定</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="Controller/editEventTitle.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">編緝日程</h4>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">標題</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="請輸入">
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">顏色</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
						  <option value="">請選擇</option>
						  <option style="color:#FF0000;" value="#FF0000">紅色</option>
						   <option style="color:#FF8C00;" value="#FF8C00">橙色</option>
						   <option style="color:#FFD700;" value="#FFD700">黃色</option>
						    <option style="color:#1BCD64;" value="#1BCD64">綠色</option>
						  <option style="color:#008000;" value="#008000">藍色</option>	
						   <option style="color:#C51BCD;" value="#C51BCD">紫色</option>							  
						 
						</select>
					</div>
				  </div>
				    <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete">刪除日程</label>
						  </div>
						</div>
					</div>
				  
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				<button type="submit" class="btn btn-primary">確定</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	
	<script>
	var date = new Date();
	var today = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate();
	

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
	
			
			defaultDate: today,
			editable: true,
			eventLimit: true, 
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
			?>
				{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $event['title']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
				},
			<?php endforeach; ?>
			]
		});
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'Controller/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('已儲存');
					}else{
						alert('已儲存'); 
					}
				}
			});
		}
		
	});

</script>

</body>

</html>
