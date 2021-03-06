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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Butt Trades</title>
		<link rel="title icon" type="image/x-icon" href="butt.ico" />
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">	
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-12 col-md-offset-0">
					<div class="account-wall-2">
						<div id="my-tab-content" class="tab-content">
							<div class="profile-wrap">
								<span class="logo-profile">Butt Trades</span>
								<i>Buying and Selling a Piece of <b id="user"></b>'s Butt&trade;</i>
								<input id="btn" type="submit" class="btn btn-lg btn-warning btn-sm pull-right" value="Log Out" onclick="logout();"/>
								<hr class="style15">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
		
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-5 col-md-offset-0">
					<div class="account-wall-2_bal">
						<div id="my-tab-content" class="tab-content">
							<div class="profile-wrap_bal">
								<span class="logo-profile"><font color="green">Account Information</font></span>
								<br>
								<br>
								nothing to see here
							</div>
						</div>
					</div>
				</div>
				
		<div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-7 col-md-offset-0">
                            <div class="account-wall-2_bal">
                                <div id="my-tab-content" class="tab-content">
                                    <div class="profile-wrap_bal">
                                        <span class="logo-profile"><font color="indigo">Current Stock Information</font></span>
                                        <br>
                                        <br>
                                        <!-- TradingView Widget BEGIN -->
										<script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
										<script type="text/javascript">
										new TradingView.widget({
										  "width": 1200,
										  "height": 600,
										  "symbol": "FX:SPX500",
										  "interval": "D",
										  "timezone": "Etc/UTC",
										  "theme": "White",
										  "style": "1",
										  "locale": "en",
										  "toolbar_bg": "#f1f3f6",
										  "allow_symbol_change": true,
										  "details": true,
										  "calendar": true,
										  "news": [
										    "headlines"
										  ],
										  "hideideas": true,
										  "show_popup_button": true,
										  "popup_width": "1000",
										  "popup_height": "650"
										});
										</script>
										<!-- TradingView Widget END -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>				
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
		<script type="text/javascript">
			var currentUser = <?php echo json_encode($currentUser); ?>;
			document.getElementById("user").innerHTML = currentUser.toString();
			
			function logout() {
				window.open("logout.php", "_self");
			}
		</script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>																			