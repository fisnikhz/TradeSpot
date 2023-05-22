<?php
$nameErr ="";
$emailErr = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];

    //$nameErr = $emailErr = "";

    if(empty($name) && empty($email)) {
        $nameErr = "Name is required";
		$emailErr = "Email is required";
    } 
	
	else if(!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
    }
	
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
	
	else{
		header('Location: email.php');
	}
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Contact Form 06</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/contact-style.css">
	<!-- <link rel="stylesheet" href="css/hp.css"> -->
	<style>
		*{
			font-family: "Helvetica Neue", Arial, sans-serif;
		}
		.logo{
			color: White;
			padding-left: 20px;
			padding-top: 20px;
			margin-bottom: 50px;
			font-weight: bold;
		}
		.content {
			margin-left: 200px; /* Same as the width of the navbar */
			padding: 20px;
		}
		.navbar {
			display: flex;
			flex-direction: column;
			height: 100%;
			width: 200px;
			position: fixed;
			z-index: 1;
			top: 0;
			left: 0;
			background-color: #333;
			overflow-x: hidden;
			/* padding-top: 60px; */
		}
		.navbar a {
			padding-left: 16px;
			text-decoration: none;
			font-size: 25px;
			color: #818181;
		}
		.navbar a:hover {
			color: #f1f1f1;
		}
	</style>

	</head>
	<body>
	<?php include 'user_header.php'; ?>


	<section class="ftco-section content" style="margin-left: 200px;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h3>Subscribe</h3>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="wrapper">
						<div class="row no-gutters mb-5">
							<div class="col-md-7">
								<div class="contact-wrap w-100 p-md-5 p-4">
									<h3 class="mb-4">Subscribe in TradeSpot</h3>
									<form method="POST" action="email.php" id="contactForm" name="contactForm" class="contactForm">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="label" for="name">Full Name</label>
													<input type="name" class="form-control" name="name" id="name" placeholder="Name">
													<p style="color:red"><?php echo $nameErr; ?></p>
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<label class="label" for="email">Email Address</label>
													<input type="email" class="form-control" name="email" id="email" placeholder="Email">
													<p style="color:red"><?php echo $emailErr; ?></p>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="submit" value="Send Message" class="btn btn-primary">
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-5 d-flex align-items-stretch">
								<div id="map">
			          </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-map-marker"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Address:</span> Dorm (UP), Hyzri Talla, Prishtina</p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-phone"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Phone:</span> <a href="tel://1234567920">+383 44 123 123</a></p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-paper-plane"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Email:</span> <a href="mailto:info@yoursite.com">tradespotphp@gmail.com</a></p>
				          </div>
			          </div>   
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-globe"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Website</span> <a href="#">tradespot.com</a></p>
				          </div>
			          </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
  <!-- <script src="js/jquery.min.js"></script> -->
  <!-- <script src="js/popper.js"></script> -->
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <!-- <script src="js/jquery.validate.min.js"></script> -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
	</body>
</html>

