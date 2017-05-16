<?php
	session_start();
	
	if (isset($_SESSION['user'])) {
		$currentUser = $_SESSION['user'];
	}
	else {
		echo "You must be logged in to view your profile.";
		exit;
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=720, initial-scale=1">
		
		<title>Bank of Butt</title>
		<link rel="title icon" type="image/x-icon" href="butt.ico" />
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- Use the appropriate CSS file -->
		<link href="css/profile.css" rel="stylesheet"> 
	</head>
	<body>
		<!-- Mobile div tag -->
		<div style="min-width: 470px; margin: 0 auto;">
			<!-- Logo Banner -->
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-md-10 col-md-offset-1">
						<div class="banner">
							<div id="my-tab-content" class="tab-content">
								<span class="logo-profile">Bank <small>of</small> Butt</span><br>
								<i>Smoother than <b id="user"></b>'s Butt&trade;</i>
								<a href="logout.php" class="btn btn-lg btn-warning btn-sm pull-right">
									<span class="glyphicon glyphicon-log-out"></span>&nbsp; Log out
								</a>
								<a href="btrades.php" class="btn btn-lg btn-success btn-sm pull-right">
									<span class="glyphicon glyphicon-piggy-bank"></span>&nbsp; Butt-Trades
								</a>	
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Information columns  -->
			<div class="container">
				<div class="row">
					<!-- Account Details, Deposit Funds, Transfer Funds -->
					<div class="col-sm-5 col-md-4 col-md-offset-1">
						<div class="details">
							<div id="my-tab-content" class="tab-content">
								<span class="logo-profile"><font color="green">eBanking Account - <z id="accNum"></z></font></span><br><br>
								<p class="div1" id="div1"></p>
								<hr>
								<div id="accountTabbing">
									<span class="logo-profile"><font color="seagreen">Deposit Funds</font></span>
									<a href="#" style='text-decoration:none;' class="btn2 btn-lg btn-info btn-xs pull-right" onclick="transferTab();">
										<span class="glyphicon glyphicon-chevron-right"></span>&nbsp; Transfer
									</a><br><br>
									<div id="transfer" class="transfer">
										<x id="transferString">Enter the amount to deposit.</x><br>
										<form name="form1" id="form1" class="form-signin" action="" method="POST"><br>
											<input type="number" name="funds7" placeholder="Funds" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c1" required>
											<input type="submit" class="btn btn-md btn-primary btn-block" value="Deposit" onclick="deposit();"/>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>	
					<!-- Statements -->
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-6 col-md-offset-0">
								<div class="statements">
									<div id="my-tab-content" class="tab-content">
										<span class="logo-profile"><font color="black">Statements</font></span>
										<m id="mandm"></m>
										<br><br>
										<v id="statementTab">
										</v>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--
			<div id="boxes">
			<div id="dialog" class="window">
			Your Content Goes Here
			<div id="popupfoot"> <a href="#" class="close agree">I agree</a> | <a class="agree"style="color:red;" href="#">I do not agree</a> </div>
			</div>
			<div id="mask"></div>
			</div>
		-->
		
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- monsterstrikedb -->
		<ins class="adsbygoogle"
		style="display:inline-block;width:336px;height:280px"
		data-ad-client="ca-pub-2480241576189687"
		data-ad-slot="2687555459"></ins>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>		  
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
		<script type="text/javascript">
			/*
			$(document).ready(function() {	
				
				var id = '#dialog';
				
				//Get the screen height and width
				var maskHeight = $(document).height();
				var maskWidth = $(window).width();
				
				//Set heigth and width to mask to fill up the whole screen
				$('#mask').css({'width':maskWidth,'height':maskHeight});
				
				//transition effect
				$('#mask').fadeIn(500);	
				$('#mask').fadeTo("slow",0.9);	
				
				//Get the window height and width
				var winH = $(window).height();
				var winW = $(window).width();
				
				//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
			
			//transition effect
			$(id).fadeIn(2000); 	
			
			//if close button is clicked
			$('.window .close').click(function (e) {
				//Cancel the link behavior
				e.preventDefault();
				
				$('#mask').hide();
				$('.window').hide();
			});
			
			//if mask is clicked
			$('#mask').click(function () {
				$(this).hide();
				$('.window').hide();
			});
			
			});
			*/
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			var currentUser = <?php echo json_encode($currentUser); ?>;
			document.getElementById("user").innerHTML = currentUser.toString(); // Code for the slogan
			
			var size = false;
			
			// Loads account details at page load
			$.post('getinfo.php', {
				user: currentUser
				}, function(data){
				var arrName1 = data.split('*');
				
				$('#div1').html(accountDetails(arrName1)); 
			});
			
			$.post('getstatements.php', {
				user: currentUser
				}, function(data){
				var split = data.split('~');
				
				var type = split[0];
				var amount = split[1];
				var date = split[2];
				var time = split[3];
				
				var typeS = type.split('*');
				var amountS = amount.split('*');
				var dateS = date.split('*');
				var timeS = time.split('*');
				
				$('#statementTab').html(statementDetails(typeS, amountS, dateS, timeS));
			});	
			
			// HTML table string for account details
			function accountDetails(account) {
				var data = 
				"<table style='width:100%'>" +
				"<tr>" +
				"<td>First Name</td>" +
				"<td align='right'>" + account[0] + "</td>" +		
				"</tr>" +
				"<tr>" +
				"<td>Last Name</td>" +
				"<td align='right'>" + account[1] + "</td>" +	
				"</tr>" + 
				"<tr>" +
				"<td> </td>" +
				"<td align='right'> </td>" +	
				"</tr>" + "</table>" + "<br>" +
				"<table style='width:100%'>" +
				"<tr>" +
				"<td>Balance</td>" +
				"<td align='right'>$" + account[3] + "</td>" +	
				"</tr>" +
				"</table>";
				document.getElementById("accNum").innerHTML = account[4].toString();
				
				return data;
			}
			
			function transfer() {
				$(document).ready(function(){
					$("#form1").validate({
						debug: false,
						submitHandler: function(form) {
							$.post('transfer.php?name=' + currentUser, $("#form1").serialize(), function(data) {
								if (data.charAt(0) == "$") { // Checks if there is an error based on first character
									refreshDetails();
									refreshStatements();
									$('#transferString').html('<font color="green">' + data + '</font>');
								}
								else {
									$('#transferString').html('<font color="red">' + data + '</font>');
								}
							});
						}
					});
				});
			}
			
			function deposit() {
				$(document).ready(function(){
					$("#form1").validate({
						debug: false,
						submitHandler: function(form) {
							$.post('deposit.php?name=' + currentUser, $("#form1").serialize(), function(data) {
								if (data.charAt(0) == "$") { // Checks if there is an error based on first character
									refreshDetails();
									refreshStatements();
									$('#transferString').html('<font color="green">' + data + '</font>');
								}
								else {
									$('#transferString').html('<font color="red">' + data + '</font>');
								}
							});
						}
					});
				});
			}
			
			// Refreshes account details when depositing or transferring
			function refreshDetails() {
				$.post('getinfo.php', {
					user: currentUser
					}, function(data){
					var arrName1 = data.split('*');
					$('#div1').html(accountDetails(arrName1));
				});
			}
			
			function refreshStatements() { // getstatements
				$.post('getstatements.php', {
					user: currentUser
					}, function(data){
					var split = data.split('~');
					
					var type = split[0];
					var amount = split[1];
					var date = split[2];
					var time = split[3];
					
					var typeS = type.split('*');
					var amountS = amount.split('*');
					var dateS = date.split('*');
					var timeS = time.split('*');
					
					$('#statementTab').html(statementDetails(typeS, amountS, dateS, timeS));
				});	
			}
			
			function statementDetails(type, amount, date, time) {				
				if (type[0] == "") {
					return "<div id='transfer' class='transfer'>No statements are available.</div>";
				}
				else {
					if (size == false) {
						if (type.length > 15) {
							
							var firstString = "<table style='width:100%'><tr><td><b>Timestamp</b></td><td><b>Transaction Type</b></td><td align='right'><b>Amount</b></td></tr>";
							var lastString = "</table>";
							var body = "";
							for (i = type.length - 15; i < type.length; i++) { 
								body  += 
								"<tr>" + 
								"<td>" + date[i] + " <small>" + time[i] + "</small></td>" +
								"<td>" + type[i] +"</td>" +
								"<td align='right'>$" + amount[i] + "</td>" +
								"<tr>";
							}
							
							var maxi = 
							"<a href='#' style='text-decoration:none;' class='btn2 btn-lg btn-info btn-xs pull-right' onclick='max();'>" +
							"<span class='glyphicon glyphicon-plus'></span>&nbsp; View All</a>";
							$('#mandm').html(maxi);
							
							return firstString + body + lastString; 
						}
						else {
							var firstString = "<table style='width:100%'><tr><td><b>Timestamp</b></td><td><b>Transaction Type</b></td><td align='right'><b>Amount</b></td></tr>";
							var lastString = "</table>";
							var body = "";
							for (i = 0; i < type.length; i++) { 
								body  += 
								"<tr>" + 
								"<td>" + date[i] + " <small>" + time[i] + "</small></td>" +
								"<td>" + type[i] +"</td>" +
								"<td align='right'>$" + amount[i] + "</td>" +
								"<tr>";
							}
							return firstString + body + lastString;
						}
					}	
					else {
						var firstString = "<table style='width:100%'><tr><td><b>Timestamp</b></td><td><b>Transaction Type</b></td><td align='right'><b>Amount</b></td></tr>";
						var lastString = "</table>";
						var body = "";
						for (i = 0; i < type.length; i++) { 
							body  += 
							"<tr>" + 
							"<td>" + date[i] + " <small>" + time[i] + "</small></td>" +
							"<td>" + type[i] +"</td>" +
							"<td align='right'>$" + amount[i] + "</td>" +
							"<tr>";
						}
						
						var mini = 
						"<a href='#' style='text-decoration:none;' class='btn2 btn-lg btn-info btn-xs pull-right' onclick='min();'>" +
						"<span class='glyphicon glyphicon-minus'></span>&nbsp; Show Less</a>";
						$('#mandm').html(mini);
						
						return firstString + body + lastString;
					}
				}
			}
			
			function max() {
				size = true;
				refreshStatements();
			}
			
			function min() {
				size = false;
				refreshStatements();
			}
			
			// Changes tab to transfer funds
			function transferTab() {
				var htmlString = 
				"<span class='logo-profile'><font color='darkorange'>Transfer Funds</font></span>" +
				"<a href='#' style='text-decoration:none;' class='btn2 btn-lg btn-info btn-xs pull-right' onclick='depositTab();'>" +
				"<span class='glyphicon glyphicon-chevron-left'></span>&nbsp; Deposit</a><br><br>" +
				"<div id='transfer' class='transfer'>" +
				"<x id='transferString'>Enter the target account and amount to transfer.</x><br>" +
				"<form name='form1' id='form1' class='form-signin' action='' method='POST'><br>" +
				"<input type='number' name='targetAcc' id='targetAcc' class='form-control' placeholder='Target Account' required>" +
				"<input type='number' name='funds' placeholder='Funds' min='0' step='0.01' data-number-to-fixed='2' data-number-stepfactor='100' class='form-control currency' id='c1' required>" +
				"<input type='submit' class='btn btn-md btn-primary btn-block' value='Transfer' onclick='transfer();'/></form>" +
				"</div>";
				
				$('#accountTabbing').html(htmlString);
			}
			
			function depositTab() {
				var htmlString = 
				"<span class='logo-profile'><font color='seagreen'>Deposit Funds</font></span>" +
				"<a href='#' style='text-decoration:none;' class='btn2 btn-lg btn-info btn-xs pull-right' onclick='transferTab();'>" +
			"<span class='glyphicon glyphicon-chevron-right'></span>&nbsp; Transfer</a><br><br>" +
			"<div id='transfer' class='transfer'>" +
			"<x id='transferString'>Enter the amount to deposit.</x><br>" +
			"<form name='form1' id='form1' class='form-signin' action='' method='POST'><br>" +
			"<input type='number' name='funds7' placeholder='Funds' min='0' step='0.01' data-number-to-fixed='2' data-number-stepfactor='100' class='form-control currency' id='c1' required>" +
			"<input type='submit' class='btn btn-md btn-primary btn-block' value='Deposit' onclick='deposit();'/></form>" +
			"</div>";
			
			$('#accountTabbing').html(htmlString);
	}
</script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>																			