<?php
if(empty($_POST) === false) {

	session_start();

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$errors = array();

	if(isset($_POST['name'], $_POST['email'], $_POST['message'])) {
			$fields = array(
				'name'		=> $_POST['name'],
				'email'		=> $_POST['email'],
				'message'	=> $_POST['message']
			);

			foreach ($fields as $field => $data) {
				if(empty($data)) {
					//$errors[] = "The " . $field . " is required";
					$errors[] = "Please fill-up the form correctly.";
					break 1;
				}
			}


			if(empty($errors) === true) {
				if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$errors[] = "Oops! Invalid E-mail!";
				}
			}



			if(empty($errors) === true) {
				$name 		= test_input($_POST['name']);
				$email 		= test_input($_POST['email']);
				$message 	= test_input($_POST['message']);

				$to 		= "your-email@gmail.com";
				$subject 	= "Your Website Name: You have a new message from " . $name;
				
				$body 		= "
					<html>
						<head>
							<title></title>
							<style>
								* {
									margin: 0;
									padding: 0;
								}
								body {
									background-color: #EEEEEE;
								}
								.main {
									width: 960px;
									margin: 0px;
									background-color: white;
									padding: 0px;
								}
								h4 {
									color: navy;
								}
								table {
									margin-top: 15px;
									margin-bottom: 15px;
								}
								table, tr, th, td {
									border: 1px solid lightGray;
									border-collapse: collapse;
								}
								th {
									font-size: 15px;
									font-weight: normal;
									line-height: 25px;
									padding: 5px;
									text-align: left;
									color: darkred;
								}
								td {
									font-size: 15px;
									font-weight: normal;
									line-height: 25px;
									padding: 5px;
									text-align: left;
									color: darkgreen;
								}
							</style>
						</head>
						<body>
							<div class='main'>
								<h4>Hello,<br>I am $name, my quote is below - </h4>
								<table>
									<tr>
										<th>Name</th>
										<td>$name</td>
									</tr>
									<tr>
										<th>E-mail</th>
										<td>$email</td>
									</tr>
									<tr>
										<th>Message</th>
										<td>$message</td>
									</tr>
								</table>
							</div>
						</body>
					</html>
				";


if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    $data = $_POST['name'] . ' == Email: ' . $_POST['email'] . ' Message: ' . $_POST['message'] . "\r\n";
    $ret = file_put_contents('entries.log', $data, FILE_APPEND | LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {
        echo "$ret bytes written to file";
    }
}
else {
	header('location: redirect.html');
}



			    // Always set content-type when sending HTML email
			    $headers = "MIME-Version: 1.0" . "\r\n";
			    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			    // More headers
			    $headers .= 'From:Nate Duhamell <no-Reply@yourdomain.com>' . "\r\n";
			    $headers .= "Reply-To: " . $email . "(" . $name . ")" . "\r\n";

			    mail($to,$subject,$body,$headers);

				session_unset();
				session_destroy();
			    
				header('location: redirect.html');
				exit();
			
			} elseif(empty($errors) === false) {
				$_SESSION['fields'] = $fields;
				$_SESSION['errors'] = $errors;
				header('location: error.php');
				exit();
			}


	}


} else {
	header('location: redirect.html');
	exit();
}
?>
