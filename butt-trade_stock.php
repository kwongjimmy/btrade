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
		<link href="css/stock1.css" rel="stylesheet"> 
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	</head>
	<body>
		<div style="min-width: 600px; margin: 0 auto;">
			<div id="banner">
				<div id="logMargin">
					<a href="logout.php" class="btn btn-lg btn-success btn-sm pull-right">
						<span class="glyphicon glyphicon-log-out"></span>&nbsp; Log out
					</a>
				</div>
				<div id="blank"></div>
				<a href="transact.php" class="btn btn-lg btn-warning btn-sm pull-right">
					<span class="glyphicon glyphicon-user"></span>&nbsp; Transactions
				</a>
				<div id="blank"></div>
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
					<div class="col-sm-5 col-md-6 col-md-offset-0">
						<div class="page1">
							<div id="my-tab-content" class="tab-content" align="center">
								<div id="buttview" class="buttview"><b><span><small>STOCK INQUIRY</small></span></b></div></br>
								<p class="bodyText">
									<z id="error">Enter a ticker or company name.</z>
									<form name="form1" id="form1" class="form-signin" action="" method="POST" onclick="test();">
										<input type="text" name="stock" id="searchStocks1" class="form-control" placeholder="ex. AAPL or Apple Inc." required>
										<br>
										<input type="submit" class="btn btn-md btn-primary btn-block" value="Search" style="width: 450px;"/>
									</form>
									<script>
										var symbols = [];
										$.ajax ( {
											type: 'post',
											url: "getStockSymbols.php",
											dataType: "json",
											async: false,
											success: function (data) {
												symbols = data;	
											}
										});
										$( "#searchStocks1" ).autocomplete({
											source: symbols
										});
									</script>
								</p>
							</div>
						</div>	
					</div>
					
					<!-- ad? -->
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-6 col-md-offset-0">
								<div class="page5">
									<div id="my-tab-content" class="tab-content">
										<h id="stockInfo">
											<div align="center">
												<a href="#"><img src="sport.gif"
													alt="sport"
												width="480" height="160" border="0" style="margin-top: 5px;"/></a>
											</div>
										</h>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="container">
				<div class="row">
					<div class="col-sm-5 col-md-12 col-md-offset-0">
						<j id="tradeview">
							<div class="page2">
								<div id="my-tab-content" class="tab-content">
									<p class="bodyText">
										
										<!-- TradingView Widget BEGIN -->
										
										<div style="height: 400px">
											<script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
											<script type="text/javascript">
												// DANK PHP INCOMING
												<?php 
													$stock_ticker = $_GET['name'];
												?>
												var stock_ticker = <?php echo json_encode($stock_ticker); ?>;
												
												var hello = new TradingView.widget({
													"autosize": true,
													"symbol": stock_ticker,
													"interval": "D",
													"timezone": "America/Los_Angeles",
													"theme": "White",
													"style": "8",
													"locale": "en",
													"toolbar_bg": "rgba(66, 66, 66, 1)",
													"withdateranges": true,
													"allow_symbol_change": false,
													"save_image": false,
													"hideideas": true,
													"show_popup_button": false,
													"popup_width": "1000",
													"popup_height": "650"
												});
											</script>
										</div>
										<!-- TradingView Widget END -->
									</p>
								</div>
							</div>
						</j>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-5 col-md-12 col-md-offset-0">
					<div class="pagehead">
						<div id="my-tab-content" class="tab-content">
							<p class="bodyText">
								<d id="headlines">
								</d>
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
		// DANK PHP INCOMING
		<?php 
			$stock_ticker = $_GET['name'];
		?>
		
		var stock_ticker = <?php echo json_encode($stock_ticker); ?>;
		var currentUser = <?php echo json_encode($currentUser); ?>;
		$.get("https://query.yahooapis.com/v1/public/yql?q=select%20title%2C%20link%2C%20description%2C%20pubDate%20from%20rss%20where%20url%3D'http%3A%2F%2Ffinance.yahoo.com%2Frss%2Fheadline%3Fs%3D" + stock_ticker
		+ "'&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys", function (data) {
			$(data).find("item").each(function () {
				var el = $(this);
				news = '<tr><td><a href="'+ el.find("link").text() + '"> "' + el.find("title").text() +'" </td></tr>';
				$("#news-feed").append(news);
			});
			
		});
		
		$('#stockInfo').html(stockInfoString(stock_ticker));
		$('#headlines').html(headliner());
		setYahooQuery(stock_ticker);
		
		
		
		function headliner() {
			var hell = "<div id='buttview' class='buttview'><b><span><small>HEADLINE NEWS</small></span></b></div></br><table id = 'news-feed' class = 'news' style ='width:95%' border = '1'>"
			
			
			return hell;
		}
		
		function test() {
			$(document).ready(function(){
				$("#form1").validate({
					debug: false,
					submitHandler: function(form) {
						$.post('stockTest1.php', $("#form1").serialize(), function(data) {
							if (data.charAt(0) != "<") {
								window.open("butt-trade_stock.php?name=" + data, "_self");
							}
							else {
								$('#error').html(data);
							}
						});
					}
				});
			});
		}
		
		function stockInfoString(data) {
			var str = 			
			"<div id='buttview' class='buttview' align='center'><b><span><small>" + data.toUpperCase() + "</small></span></b></div></br>" +
			"<p class='bodyText'>" +
			"</p>" + "<c id='stockInfo2'></c>";
			
			return str;
		}
		
		// START: yahoo code
		
		var change;
		var perChange;
		var lstPrice;
		var totalPrice;
		var numShares;
		
		function setYahooQuery(data)
		{
			url = "https://query.yahooapis.com/v1/public/yql";
			query = "select * from yahoo.finance.quotes where symbol = " + "'" + data + "'";
			query = encodeURIComponent(query);
			executeYahooQuery(query);
			console.log(query);
			
			
		}			
		
		function executeYahooQuery(query)
		{
			$.ajax({
				url: url+"?q="+query+"&format=json&diagnostics=true&env=http://datatables.org/alltables.env",
				dataType: 'json',
				async: false,
				success: function(data) {
					stringStock(data);
				}
			});
			
		}
		
		
		function stringStock(data) {
			var stringStock = 
			"<table style='width:95%'>" +
			"<tr>" + 
			"<td>Price Change</td>" +
			"<td id = 'daychange' align='right'></td>" +		
			"</tr>" + 
			"<tr>" + 
			"<td>Percent Difference</td>" + 
			"<td align='right' id = 'perChange'></td>" +
			"</tr>" + 
			"<tr>" +
			"<td></td>" +
			"<td align='right'> </td>" +
			"</tr>" + 
			"</table>" +
			"<table style='width:95%'>" +
			"<tr>" +
			"<td>Closing Price</td>" +
			"<td align='right' id = 'lstPrice'></td>" +
			"</tr>" +
			"</table><br><br><br><br>" +
			"Buying Price<input id = 'numInput2' type = 'number' value = '1' size = '30' required    />"+
			"Num Of Shares<input id = 'numInput' type = 'number' value = '1' size = '30' required    />"+
			"<button type='button' onclick='confirmPurchase()'>buy</button>" +
			"<button type='button' onclick='confirmSell()'>sell</button>"+
			"<button type='button' onclick='confirmLimitBuy()'>limit buy</button>" +
			"<button type='button' onclick='confirmLimitSell()'>limit sell</button>";
			
			
			/*
			"Buying Price<input id = 'numInput2' type = 'number' value = '1' size = '30' required    />"+
			"Num Of Shares<input id = 'numInput' type = 'number' value = '1' size = '30' required    />"+
			"<div id='buybtn'><a href='#' class='btn btn-lg btn-danger btn-sm pull-right'>" +
			"<span class='glyphicon glyphicon-tasks' onclick= 'confirmSell();'></span>&nbsp; Sell" +
			"</a></div>"+
			"<div id='sellbtn'><a href='#' class='btn btn-lg btn-success btn-sm pull-right'>" +
			"<span class='glyphicon glyphicon-shopping-cart' onclick= 'confirmPurchase();'></span>&nbsp; Buy" +
			"</a></div>"; // buttons
			*/
			$('#stockInfo2').html(stringStock);
			
			
			var stock1 = data.query.results.quote;
			change = stock1.Change.replace("+","");
			var changeToFloat = parseFloat(change);
			if(changeToFloat > 0) {					
				document.getElementById("daychange").innerHTML = "<td><font color = 'green'>" + change +"</font></td>";
			}
			else {
				document.getElementById("daychange").innerHTML = "<td><font color='red'>" + change +"</font></td>";
			}
			perChange = stock1.ChangeinPercent;
			lstPrice = stock1.LastTradePriceOnly;
			console.log(perChange);
			if(parseFloat(perChange) > 0) {					
				document.getElementById("perChange").innerHTML = "<td><font color = 'green'>" + perChange +"</font></td>";
			}
			else {
				document.getElementById("perChange").innerHTML = "<td><font color='red'>" + perChange +"</font></td>";
			}
			document.getElementById("lstPrice").innerHTML= lstPrice;
			document.getElementById("modal-price").innerHTML=  "$" + lstPrice;
			
			return stringStock;
		}
		function confirmLimitSell() {
			alert("you have limit sell yay");
			
			console.log("hi");
			var pce = document.getElementById("numInput2").value;
			var num = document.getElementById("numInput").value;
			$.ajax({
				type: "POST",
				url: "limitsell.php",
				data: {
					user: currentUser,
					stockSymbol: stock_ticker,
					shares:num,
					price: pce
				},
				success: function(data) {
					//console.log(data);
					console.log(data);
					//location.reload();
				}
			}); 
			
		}
		function confirmLimitBuy() {
			alert("you have limit bought");
			
			var num = document.getElementById("numInput").value;
			var pce = document.getElementById("numInput2").value;
		
			console.log(pce);
			$.ajax({
				type: "POST",
				url: "limitbuy.php",
				data: {
					user: currentUser,
					stockSymbol: stock_ticker,
					shares:num,
					price: pce
				},
				success: function(data) {
					//console.log(data);
					console.log("you have limit sold");
					//location.reload();
				}
			}); 
			
		}
		function confirmSell() {
			alert("you have sold gratz");
			
			console.log("hi");
			var num = document.getElementById("numInput").value;
			$.ajax({
				type: "POST",
				url: "sellstock.php",
				data: {
					user: currentUser,
					stockSymbol: stock_ticker,
					shares:num,
					price: lstPrice
				},
				success: function(data) {
					//console.log(data);
					console.log(data);
					//location.reload();
				}
			}); 
			
		}
		function confirmPurchase() {
			alert("you have bought");
			
			var num = document.getElementById("numInput").value;
			$.ajax({
				type: "POST",
				url: "buystock.php",
				data: {
					user: currentUser,
					stockSymbol: stock_ticker,
					shares:num,
					price: lstPrice
				},
				success: function(data) {
					//console.log(data);
					console.log(data);
					//location.reload();
				}
			}); 
			
		}
		// END YAHOO CODE
		
	</script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>																													