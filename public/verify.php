<?php
	require_once __DIR__.'/../bootstrap/autoload.php';
	$connectionString = "mysql:dbname={$database};host={$host};charset=utf8mb4";
        $auth = new \Delight\Auth\Auth(new \PDO($connectionString, $user, $pass));

	if( isset($_GET["selector"]) && isset($_GET["token"]) ){
		try {
			$auth->confirmEmailAndSignIn($_GET["selector"], $_GET["token"]);
			header('Location: ./add.php');
			die();
		} catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
                        echo "Something seems wrong with the provided token pair. Try the link sent to you again or fill it in manually below.";
                } catch (\Delight\Auth\TooManyRequestsException $e) {
                        echo "You've tried to log in too many times, please wait and try again";
		} catch (\Delight\Aith\TokenExpiredException $e) {
			echo "The verification token you used has expired";
		} catch (\Delight\Auth\UserAlreadyExistsException $e) {
			echo "You've tried to register an email that is already in use. Not sure how you managed that";
                } catch (Exception $e) {
			echo "Some undefined error occured. Writing log. ";
			$result = file_put_contents("error.log", $e->getMessage(), FILE_APPEND);
			echo $result ? "Log written successfully" : "Failed to write log, check php log ¯\_(ツ)_/¯";
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
		<form class="col s12" action="./verify.php" method="get">
			<div class="row">
				<div class="input-field col s12">
					<input id="selector" name="selector" type="text" required="required">
					<label for="selector">Selector</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="token" name="token" type="text" required="required">
					<label for="token">Token</label>
				</div>
			</div>
			<div class="right">
				<button class="btn waves-effect waves-light" type="submit" name="action">Verify Account<i class="material-icons right">send</i></button>
			</div>
		</form>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
</body>
</html>
