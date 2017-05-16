<?php
	require("config.php");
	require("connection.php");

	if($conn){	    	

		//UPDATE STOCKS TO LATEST PRICE
		$yql_query_url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22AXP%22%2C%22BA%22%2C%22CAT%22%2C%22CVX%22%2C%22DIS%22%2C%22DD%22%2C%22XOM%22%2C%22GE%22%2C%22GS%22%2C%22HD%22%2C%22IBM%22%2C%22JNJ%22%2C%22JPM%22%2C%22KO%22%2C%22MMM%22%2C%22MCD%22%2C%22MRK%22%2C%22NKE%22%2C%22PFE%22%2C%22PG%22%2C%22TRV%22%2C%22UTX%22%2C%22UNH%22%2C%22VZ%22%2C%22V%22%2C%22WMT%22%2C%22AAL%22%2C%22AAPL%22%2C%22ADBE%22%2C%22ADI%22%2C%22ADP%22%2C%22ADSK%22%2C%22AKAM%22%2C%22ALXN%22%2C%22AMAT%22%2C%22AMGN%22%2C%22AMZN%22%2C%22ATVI%22%2C%22AVGO%22%2C%22BBBY%22%2C%22BIDU%22%2C%22BIIB%22%2C%22BMRN%22%2C%22CA%22%2C%22CELG%22%2C%22CERN%22%2C%22CHKP%22%2C%22CHRW%22%2C%22CHTR%22%2C%22CMCSA%22%2C%22CMCSK%22%2C%22COST%22%2C%22CSCO%22%2C%22CTSH%22%2C%22CTXS%22%2C%22DISCA%22%2C%22DISCK%22%2C%22DISH%22%2C%22DLTR%22%2C%22EA%22%2C%22EBAY%22%2C%22ESRX%22%2C%22EXPD%22%2C%22EXPE%22%2C%22FAST%22%2C%22FB%22%2C%22FISV%22%2C%22FOX%22%2C%22FOXA%22%2C%22GILD%22%2C%22GMCR%22%2C%22GOOG%22%2C%22GOOGL%22%2C%22GRMN%22%2C%22HSIC%22%2C%22ILMN%22%2C%22INCY%22%2C%22INTC%22%2C%22INTU%22%2C%22ISRG%22%2C%22JD%22%2C%22KHC%22%2C%22KLAC%22%2C%22LBTYA%22%2C%22LBTYK%22%2C%22LILA%22%2C%22LILAK%22%2C%22LLTC%22%2C%22LMCA%22%2C%22LRCX%22%2C%22LVNTA%22%2C%22MAR%22%2C%22MAT%22%2C%22MDLZ%22%2C%22MNST%22%2C%22MSFT%22%2C%22MU%22%2C%22MYL%22%2C%22NFLX%22%2C%22NTAP%22%2C%22NVDA%22%2C%22NXPI%22%2C%22ORLY%22%2C%22PAYX%22%2C%22PCAR%22%2C%22PCLN%22%2C%22PYPL%22%2C%22QCOM%22%2C%22QVCA%22%2C%22REGN%22%2C%22ROST%22%2C%22SBAC%22%2C%22SBUX%22%2C%22SIRI%22%2C%22SNDK%22%2C%22SPLS%22%2C%22SRCL%22%2C%22STX%22%2C%22SYMC%22%2C%22SWKS%22%2C%22TSCO%22%2C%22TSLA%22%2C%22TRIP%22%2C%22TXN%22%2C%22VIAB%22%2C%22VIP%22%2C%22VOD%22%2C%22VRSK%22%2C%22VRTX%22%2C%22WBA%22%2C%22WDC%22%2C%22WFM%22%2C%22WYNN%22%2C%22XLNX%22%2C%22YHOO%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=";

		$session = curl_init($yql_query_url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

		$json = curl_exec($session);
		curl_close($session);
		$phpObj = json_decode($json,true);
		$length = $phpObj['query']['count'];
		for($i = 0; $i < $length; $i++)
		{
		    $symbol = $phpObj['query']['results']['quote'][$i]['symbol'];
		    $price = $phpObj['query']['results']['quote'][$i]['LastTradePriceOnly'];
		   	$sql = "UPDATE stocks SET price = $price WHERE name1 = '$symbol'";
		    mysql_query($sql);
		}
		//END OF UPDATING


		//CHECKING LIMITBUY TABLE
		$sql = "SELECT * FROM limitbuy";
		$result = mysql_query($sql);
		while($row = mysql_fetch_assoc($result)) {

			//GET ROW INFORMATION: STOCKSYMBOL, # OF SHARES, PRICE, USERNAME
			$stock = $row["stock"];
			$shares = $row["shares"];
			$price = $row["price"];
			$username = $row["username"];

			//GET CURRENT PRICE OF USER'S CHOSEN STOCK
			$sql = "SELECT price FROM stocks WHERE name1 = '$stock'";
			$result = mysql_query($sql);
			$row = mysql_fetch_row($result);
			$currentprice = $row[0];

			//CHECK TO SEE IF CURRENT PRICE IS EITHER WHAT USER WANTS OR LOWER
			if($currentprice <= $price)
			{
				//IF CURRENT PRICE IS LOWER THAT WHAT USER WANTS THEN REFUND
				//AMOUNT CHARGED DURING BUYLIMIT
				$refundAmount = $price - ($currentprice * $shares);
				$sql = "UPDATE users SET balance = balance + $refundAmount WHERE username = $username";
				mysql_query($sql);
				
				//GET STOCKTRACTION TABLE OF USER
				$sql = "SELECT stocktransaction FROM users WHERE username = '$username'";
				$result = mysql_query($sql);
				$row = mysql_fetch_row($result);
				$stocktransaction = $row[0];

				$date = date("M d, Y"); //GET CURRENT DATE
				$time = date("h:i:s A"); //GET CURRENT TIME

				//ADD STOCK TRANSACTION 'LIMIT-BOUGHT' OF USER'S CHOSEN STOCK
				$sql = "INSERT INTO $stocktransaction VALUES ('LIMIT-BOUGHT','$stock', '$shares', '$date', '$time')");
				mysql_query($sql);
				
				//ADD BANK TRANSACTION 'LIMIT-BUY' PRICE OF TRANSACTION
				$price = -$price; //NEGATIVE
				$sql = "INSERT INTO $banktransaction VALUES ('LIMIT-BUY', '$price', '$date', '$time')";
				mysql_query($sql);

				//DELETE THE ROW AFTER THE INSERT AND UPDATE HAS BEEN COMPLETED
				$sql = "DELETE FROM limitbuy WHERE stock = '$stock', shares = '$shares', price = '$price', username = '$username' LIMIT 1";	
				mysql_query($sql);
			}//END OF IF-STATEMENT
		}//END OF LOOP
		//END OF LIMITBUY

		//CHECKING LIMITSELL TABLE
		$sql = "SELECT * FROM limitsell";
		$result = mysql_query($sql);
		while($row = mysql_fetch_assoc($result)) {
			//GET ROW INFORMATION: STOCKSYMBOL, # OF SHARES, PRICE, USERNAME
			$stock = $row["stock"];
			$shares = $row["shares"];
			$price = $row["price"];
			$username = $row["username"];

			//GETTING PRICE OF USER'S CHOSEN STOCK
			$sql = "SELECT price FROM stocks WHERE name1 = '$stock'";
			$result = mysql_query($sql);
			$row = mysql_fetch_row($result);
			$currentprice = $row[0];
			
			//CHECK TO SEE IF CONDITION IS MET : 
			//SELL PRICE IS GREATER THAN OR EQUAL TO WHAT THE USER'S WANT
			if($currentprice >= $price)
			{
				//GET TOTAL PRICE EARNED
				//AND UPDATE USER BALANCE
				$totalprice = $currentprice * $shares;
				$sql = "UPDATE users SET balance = balance + $totalprice WHERE username = $username";
				mysql_query($sql);

				//GET STOCK TRANSACTION TABLE OF USER
				$sql = "SELECT stocktransaction FROM users WHERE username = '$username'";
				$result = mysql_query($sql);
				$row = mysql_fetch_row($result);
				$stocktransaction = $row[0];

				$date = date("M d, Y"); //GET CURRENT DATE
				$time = date("h:i:s A"); //GET CURRENT TIME

				//ADD STOCK TRANSACTION 'LIMIT-SOLD' OF USER'S CHOSEN STOCK
				$sql = "INSERT INTO $stocktransaction VALUES ('LIMIT-SOLD','$stock', '$shares', '$date', '$time')");
				mysql_query($sql);
				
				//ADD BANK TRANSACTION 'LIMIT-SELL' PRICE OF TRANSACTION
				$sql = "INSERT INTO $banktransaction VALUES ('LIMIT-SELL', '$totalprice', '$date', '$time')";
				mysql_query($sql);

				//DELETE THE ROW AFTER THE INSERT AND UPDATE HAS BEEN COMPLETED
				$sql = "DELETE FROM limitbuy WHERE stock = '$stock', shares = '$shares', price = '$price', username = '$username' LIMIT 1";	
				mysql_query($sql);
			}//END OF IF STATEMENT
		}//END OF LIMITSELL TABLE LOOP
		//END OF LIMITESELL
	}