<?php // READ THIS: THIS IS A WORK-IN-PROGRESS, DO NOT DELETE
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
		
		<title>Butt-Trade</title>
		<link rel="title icon" type="image/x-icon" href="butt.ico" />
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/stock.css" rel="stylesheet"> 
	</head>
	<body>
		<div style="min-width: 470px; margin: 0 auto;">
			<div id="banner">
				<div id="logMargin">
					<a href="logout.php" class="btn btn-lg btn-success btn-sm pull-right">
						<span class="glyphicon glyphicon-log-out"></span>&nbsp; Log out
					</a>
				</div>
				<div id="blank"></div>
								<form action = "stocksPage.php" method = "post">
					<input name = "stock" id = "searchStocks" placeholder = "ex: AAPL or Apple" style="align: right;"><input type = "submit" value = "Search" style="align: right;">
				</form>
				<a href="profile.php" class="btn btn-lg btn-primary btn-sm pull-right">
					<span class="glyphicon glyphicon-piggy-bank"></span>&nbsp; Bank of Butt
				</a>
				<div id="bannerText">BUTT*TRADE</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-sm-5 col-md-12 col-md-offset-0">
						<div id="page" class="page">
							<img src="bigbutt3.png" alt="Mountain View" style="margin-top: 0px;margin-bottom: 15px;float: right; clear: right;  width: 30%;height: auto;" />
							<div id="my-tab-content" class="tab-content">
								<div id="buttview" class="buttview"><b><span>THE BUTT VIEW</span></b></div>
							</div>
						</div>
					</div>	
				</div>
			</div>		
			<div class="container">
				<div class="row">
					<div class="col-sm-5 col-md-12 col-md-offset-0">
						<div class="page1">
							<div id="my-tab-content" class="tab-content">
								<div id="buttview" class="buttview"><b><span><small>THE BUTT GRAPH</small></span></b></div></br>
								<p class="bodyText">
									<div style="height: 400px">
										<!-- TradingView Widget BEGIN -->
										<script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
										<script type="text/javascript">
											new TradingView.widget({
												"autosize": true,
												"symbol": "FX:SPX500",
												"interval": "D",
												"timezone": "America/Los_Angeles",
												"theme": "White",
												"style": "3",
												"locale": "en",
												"toolbar_bg": "rgba(66, 66, 66, 1)",
												"withdateranges": true,
												"allow_symbol_change": true,
												"save_image": false,
												"hideideas": true,
												"show_popup_button": false,
												"popup_width": "1000",
												"popup_height": "650"
											});
										</script>
										<!-- TradingView Widget END -->
									</div>
								</p>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
		<script type="text/javascript">
			
		</script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>																									