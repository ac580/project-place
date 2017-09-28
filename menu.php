
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="logo/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script
src="http://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        
        <script type="text/javascript">
        
        $(document).ready(function(){
            $('.sidebarBtn').click(function(){
                $('.sidebar').toggleClass('active');
                $('.sidebar').toggleClass('toggle');
            })
        })
        
        
        </script>

        </head>
        <body>
        

        
        
        
        <div class="headerbar">
        <img src="logo/websitelogo.png" alt="logo" class="logo">
        <nav>
        <ul>
        <li><a href="home.php">主頁</a></li>
        <li><a href="#">關於我們</a></li>
        <li><a href="#">聯繁我們</a></li>
        <li><a href="#">法律問題</a></li>
        <li><a href="#">FAQ</a></li>
        </ul>
        
        
        </nav>
        </div>
        
        
        
        
        <div class="sidebar">
        
        <ul>
        <li></li>
        <li><a href="#">更改會員資料</a></li>
        <li><a href="home.php">主頁</a></li>
        <li><a href="addClient.php">新增可約人</a></li>
        <li><a href="clientList.php">屬於您的可約人</a></li>
        <li><a href="searchClient.php">搜尋社區上可約人</a></li>
        <li><a href="notificationReceiverList.php">您收到的邀請</a></li>
        <li><a href="usersMessageList.php">您發送過的邀請</a></li>
        <li><a href="calendar.php">您的日程</a></li>
        <li><a href="home.php?logout='1'">登出</a></li>
        
        </ul>
        <button class="sidebarBtn"><span></span></button>
        </div>
        
       
	
	
	
	
		
</body>
</html>