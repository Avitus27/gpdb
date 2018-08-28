<?php
	require_once __DIR__.'/../bootstrap/autoload.php';
	$connectionString = "mysql:dbname={$database};host={$host};charset=utf8mb4";
        $auth = new \Delight\Auth\Auth(new \PDO($connectionString, $user, $pass));

	if( isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["passConf"]) && isset($_POST["email"]) ){
		if($_POST["pass"] != $_POST["passConf"])
			echo "Passwords need to match";
		else {
			try {
				$userId = $auth->register($_POST['email'], $_POST['pass'], $_POST['user'], function ($selector, $token){
					echo "Selector: {$selector}; Token: {$token}\r\n Email was: {$_POST['email']}, <a href='./verify.php?token={$token}&selector={$selector}'>click here if that is correct.</a>";
				});
			} catch (\Delight\Auth\InvalidEmailException $e) {
                	        echo "Email not valid.";
			} catch (\Delight\Auth\InvalidPasswordException $e) {
				echo "Password not valid.";
			} catch (\Delight\Auth\UserAlreadyExistsException $e) {
				echo "Username or email already in use.";
	                } catch (\Delight\Auth\TooManyRequestsException $e) {
        	                echo "You've tried to register too many times, please wait and try again";
                	} catch (Exception $e) {
				if ($e instanceof \Delight\Auth\InvalidEmailException OR $e instanceof \Delight\Auth\InvalidPasswordException) {
	                 		echo "Username or password not found";
				} else {
					echo "Some undefined error occured. Writing log. ";
					$result = file_put_contents("error.log", $e->getMessage(), FILE_APPEND);
					echo $result ? "Log written successfully" : "Failed to write log, check php log ¯\_(ツ)_/¯";
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html style="height:100%">
<head>
	<title>GPDB</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css" media="screen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./styles/style.css">
</head>
<body class="container" style="height:98%">
	<div class="row">
		<form class="col s12" action="./register.php" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="user" name="user" type="text" required="required">
					<label for="user">Username</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="email" name="email" type="email" required="required" class="validate">
					<label for"email">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="pass" name="pass" type="password" required=required">
					<label for="pass">Password</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="passConf" name="passConf" type="password" required="required">
					<label for="passConf">Confirm Password</label>
				</div>
			</div>
			<div class="right">
				<button class="btn waves-effect waves-light" type="submit" name="action">Submit<i class="material-icons right">send</i></button>
			</div>
		</form>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
</body>
</html>
