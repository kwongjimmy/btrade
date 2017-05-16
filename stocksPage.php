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
				<div class="col-sm-6 col-md-12 col-md-offset-0">
					<div class="account-wall-2">
						<div id="my-tab-content" class="tab-content">
							<div class="profile-wrap">
								<span class="logo-profile"><font color="green">Stock Lookup</font></span>
								<br>
								<br>
								<form action = "stocksPage.php" method = "post">
									<label for="searchStocks">Enter Stock Symbol or Name   </label>
									<input name = "stock" id = "searchStocks" placeholder = "ex: AAPL or Apple">
									<input type = "submit" value = "Search">
								</form>
								<script>
								console.log("test");
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
								$( "#searchStocks" ).autocomplete({
								  source: symbols
								});
								</script>
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
								<span class="logo-profile"><font color="green"><?php echo $_POST["stock"] ?> </font></span>
								<br>
								<br>
								<input id="btn" type="submit" class="btn btn-lg btn-warning btn-sm pull-left" data-toggle = "modal" data-target = "#modal-1" value="Buy"/>
								<br>
								<br>


								<div class="modal fade" id="modal-1">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								        <h4 class="modal-title">Buy <?php echo $_POST["stock"] ?></h4>
								      </div>
								      <div class="modal-body" style = "font-size = 14px">
								        <p>Number of Shares at 
								        <p id = "modal-price"</p>
								        </p>
								        <input id = "numInput" type = "number" placeholder = "Number of Shares to buy" size = "30"></input> <br><br>						        
								  		<a href="#modal-2" data-toggle="modal" data-dismiss="modal" onclick = "purchaseStock();">Next ></a>     
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
								      </div>
								    </div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->  
								 								  
								  
								  <!-- #modal 2 -->
								<div class="modal fade" id="modal-2">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								        <h4 class="modal-title">Confirm Purchase</h4>
								      </div>
								      <div class="modal-body" style = "font-size:14px">
								        <p id ="numberBought"> </p>						        
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick = "confirmPurchase();">Confirm Purchase</button>
								      </div>
								    </div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal --> 

								<table style='width:95%'>
									<tr> 
									<td>Change</td>
									<td align='right'  id = "change" ></td>		
									</tr> 
									<tr> 
									<td>Percentage Change</td> 
									<td align='right' id = "perChange"></td>
									</tr> 
									<tr>
									<td></td>
									<td align='right'> </td>
									</tr> </table>
									<table style='width:95%'>
									<tr>
									<td>Last Price</td>
									<td align='right' id = "lstPrice"></td>
									</tr>
									</table>

								<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
								<script>
								var change;
								var perChange;
								var lstPrice;
								var totalPrice;
								var numShares;
								function purchaseStock(){
									numShares = document.getElementById("numInput").value;
									totalPrice = (numShares * lstPrice + 15).toFixed(2);
									document.getElementById("numberBought").innerHTML = "You are purchasing: <br>" + numShares + " shares of <?php echo $_POST['stock'] ?> at " + lstPrice + " per share" +"<br> + $15 Transaction Fee <br><br>	"
									+"Total: $" + totalPrice;
								}
								function confirmPurchase() {
									$.ajax({
										type: "POST",
										url: "buystock.php",
										data: {
											user: currentUser,
											stockSymbol: "<?php  $symb = explode(',' ,$_POST["stock"]); echo $symb[0] ?>",
											shares:numShares,
											price: lstPrice,
											totalPrice: totalPrice
										},
										success: function(data) {
											console.log(data);
										}
									}); 
								}
								function setYahooQuery()
								{
									url = "https://query.yahooapis.com/v1/public/yql";
									query = "select * from yahoo.finance.quotes where symbol = " +  '"<?php  $symb = explode(',' ,$_POST["stock"]); echo $symb[0] ?>"';
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
									  		//Retrieving the results of the query based on company symbol 
								    		//Check https://developer.yahoo.com/yql/console/ for needed query result data.
								    		//EX: stock.symbol, stock.Change, stock.ChangeinPercent,stock.LastTradePriceOnly..
									  		stock = data.query.results.quote;
									  		//change.push(stock.Change);
								    		//percentchange.push(stock.ChangeinPercent);
								    		//price.push(stock.LastTradePriceOnly);
								    		//var test = [];
								    		//test.push(stock.Name,stock.symbol,stock.PreviousClose,stock.Open,stock.Change.replace("+",""),stock.ChangeinPercent.replace("+",""),"$ "+stock.LastTradePriceOnly,stock.Volume);
								    		change = stock.Change.replace("+","");
								    		perChange = stock.ChangeinPercent;
								    		lstPrice = stock.LastTradePriceOnly;
								    		document.getElementById("change").innerHTML= change;
								    		document.getElementById("perChange").innerHTML= perChange;
								    		document.getElementById("lstPrice").innerHTML= lstPrice;
								    		document.getElementById("modal-price").innerHTML=  "$" + lstPrice;
											//console.log(change + " " + perChange + " " + lstPrice);
								    		//console.log(stock.Change.replace("+","")+"\t"+stock.ChangeinPercent+"\t"+stock.LastTradePriceOnly);
								    		//stock.Open , stock.DaysHigh, stock.DaysLow, stock.PreviousClose 
									  		}
									});
								}
								setYahooQuery();
								</script>
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
										  "width": 600,
										  "height": 400,
										  "symbol": "<?php  $symb = explode(',' ,$_POST['stock']); echo $symb[0] ?>",
										  "interval": "D",
										  "timezone": "Etc/UTC",
										  "theme": "White",
										  "style": "1",
										  "locale": "en",
										  "toolbar_bg": "#f1f3f6",
										  "allow_symbol_change": false,
										  "details": false,
										  "calendar": false,
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
			
			$.post('getStocks.php', {
				stock: currentStock
			}, function(data){
				alert(success);
				$('#div1').html(data);
			});	
			function logout() {
				window.open("logout.php", "_self");
			}
		</script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>