<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=400, initial-scale=1">
		
		<title>Bank of Butt</title>
		<link rel="title icon" type="image/x-icon" href="butt.ico" />
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">	
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-4 col-md-offset-4">
					<div class="account-wall">
						<div id="my-tab-content" class="tab-content">
							<p class="logo">Bank <small>of</small> Butt</p>
							<p class="slogan" id="slogan" align="center"><i>Smoother than a Baby's Butt&trade;</i></p>
							<div class="tab-pane active" id="login">
								<form name="form_1" id="form_1" class="form-signin" action="" method="POST" onclick="signin();">
									<input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
									<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
									<input type="submit" class="btn btn-lg btn-primary btn-block" value="Log In" />
								</form>
								<div id="tabs" data-tabs="tabs">
									<p class="text-center" onclick="defaultSlogan();"><a href="#register" data-toggle="tab">Need an Account?</a></p>
								</div>
							</div>
							<div class="tab-pane" id="register">
								<form name="form_2" id="form_2" class="form-signin" action="" method="POST" onclick="registration();">
									<input type="text" name="n_username" id="n_username" class="form-control" placeholder="New Username" required autofocus>
									<input type="password" name="n_password" id="n_password" class="form-control" placeholder="Password" required>
									<input type="text" name="n_firstname" id="n_firstname" class="form-control" placeholder="First Name" required>
         							<input type="text" name="n_lastname" id="n_lastname" class="form-control" placeholder="Last Name" required>
									<input type="submit" class="btn btn-lg btn-warning btn-block" value="Register" />
								</form>
								<div id="tabs" data-tabs="tabs">
									<p class="text-center" onclick="defaultSlogan();"><a href="#login" data-toggle="tab">Have an Account?</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
		<script type="text/javascript">
			function signin() {
				$(document).ready(function(){
					$("#form_1").validate({
						debug: false,
						submitHandler: function(form) {
							$.post('validation.php', $("#form_1").serialize(), function(data) {
								if (data == "true") {
									defaultSlogan();
									window.open("profile.php", "_self");
								}
								else {
									$('#slogan').html('<font color="red"><i>' + data + '</i></font>');
								}
							});
						}
					});
				});
			}
			
			function registration() {
				$(document).ready(function(){
					$("#form_2").validate({
						debug: false,
						submitHandler: function(form) {
							$.post('registration.php', $("#form_2").serialize(), function(data) {
								if (data == "true") {
									$('#slogan').html('<font color="lightgreen"><i>Account Created</i></font>');
								}
								else {
									console.log(data);
									$('#slogan').html('<font color="red"><i>Username is Unavailable</i></font>');
								}
							});
						}
					});
				});
			}
			
			function defaultSlogan() {
				$('#slogan').html('<i>Smoother than a Baby&#39;s Butt&trade;</i>');
				$('#username').val('');
				$('#password').val('');
				$('#n_username').val('');
				$('#n_password').val('');
			}
		</script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>												