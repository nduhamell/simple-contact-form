<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : '';
$fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<?php if(isset($_SESSION['success'])) : ?>
		<meta http-equiv="refresh" content="3; url=../redirect.html">
	<?php elseif(!empty($errors)) : ?>
		<meta http-equiv="refresh" content="3; url=../index.html">
	<?php endif ;?>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
	<title>
		<?php if(isset($_SESSION['success'])) : ?>
			Thank you ! Your message has been sent successfully.
		<?php elseif(!empty($errors)) : ?>
			Oops! Something Went Wrong.
		<?php endif ;?>
	</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body {
			background-color: #05142e;
		}
		.container {
			width:50%;
			min-height: 250px;
			padding:50px;
			font-size:20px;
			text-align:center;
			margin:0px auto;
			background:#fff;
			color:#000;
			margin-top:100px;
			border-radius: 15px;
			font-family: 'Open Sans', sans-serif;
		}
		.container h2 {
			margin-bottom: 20px;
			font-size: 150%;
			font-weight: 800;
			font-family: 'Open Sans', sans-serif;
		}
		.success {
			color: green;
		}
		.success p {
			font-size: 18px;
			font-weight: normal;
			font-family: 'Open Sans', sans-serif;
		}
		.error {
			color: red;
		}
		.error ul li {
			list-style: outside none none;
			font-size: 18px;
			font-weight: normal;
			font-family: 'Open Sans', sans-serif;
		}
		@media only screen and (max-width: 1070px) {
			.container {
				width: 90%;
				padding: 15px 5px;
			}
		}
		@media only screen and (max-width: 500px) {
			.container h2 {
				margin-bottom: 20px;
				font-size: 20px;
				margin-top: 28px;
				font-weight: 700;
			}
		}
	</style>
</head>
<body>
	<div class="container">

		<!-- Form Notification Start -->
		<?php if(isset($_SESSION['success'])) : ?>
			<div class="success">
				<h2>Thank you!!</h2>
				<p>Your message has been sent successfully!</p>
			</div>
		<?php elseif(!empty($errors)) : ?>
			<div class="error">
				<h2>Oops! Something went wrong.</h2>
				<ul><li><?php echo implode("</li><li>", $errors) ?></li></ul>
			</div>
		<?php else : ?>
			<?php header('location: ../index.html') ?>
		<?php endif; ?>
		<!-- Form Notification End -->

	</div>
</body>
</html>
<?php
session_unset();
session_destroy();
?>