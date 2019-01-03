<?php
	require_once __DIR__.'/../bootstrap/autoload.php';

	$connectionString = "mysql:dbname={$database};host={$host};charset=utf8mb4";
	$auth = new \Delight\Auth\Auth(new \PDO($connectionString, $user, $pass));

	if( !$auth->isLoggedIn() ) {
		header('Location: ./login.php');
		die();
	} else if ( !$auth->hasRole(\Delight\Auth\Role::ADMIN) ) {
		header('Location: ./index.php');
		die();
	}
	if(isset($_POST['name']) && isset($_POST['address1']) && isset($_POST['phone'])){
		$gpName = $_POST['name'];
		$addressLineOne = $_POST['address1'];
		$phone = $_POST['phone'];

		if(isset($_POST['tf']))
			$tf = True;
		if(isset($_POST['cf']))
			$cf = True;
		if(isset($_POST['mc']))
			$mc = True;
		if(isset($_POST['ref']))
			$ref = True;

		$db = MysqliDb::getInstance();
//		$data = Array($name =>
//			$contact =>
//			$address_line_one =>
//			$address_area =>
//			$latitude =>
//			$longitude =>
//			$trans_friendly =>
//			$choice_friendly =>
//			$medical_card_friendly =>
//			$ready_to_refer =>
//		);
	}

// Add GP logic here
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
		<form class="col s12" id="add-gp" action="./add.php" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="name" name="name" type="text" required="required">
					<label for="name">Office Name:</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="address1" name="address1" type="text" required="required">
					<label for="address1">Address Line One:</label>
				</div>
			</div>
			<div class="row">
			<!-- Will be address area (i.e. the area the steet is in like Shandon, Farranree, Cork City, etc.) -->
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="phone" name="phone" type="tel">
					<label for="phone">Phone:</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<select name="county">
						<option value="" disabled selected>Choose a county</option>
<?php
	$db = MysqliDb::getInstance();
	$counties = $db->get('county');
	foreach($counties as $county){
		echo "\t\t\t\t\t\t<option value='{$county['id']}'>{$county['name']}</option>\r\n";
	}
?>
					</select>
					<label>GP County:</label>
				</div>
			</div>
			<div class="row">
				<div class="col s3"><label><input name="tf" type="checkbox" /><span>Trans-friendly</span></label></div>
				<div class="col s3"><label><input name="cf" type="checkbox" /><span>Choice-friendly</span></label></div>
				<div class="col s3"><label><input name="mc" type="checkbox" /><span>Accepts Medical Card</span></label></div>
				<div class="col s3"><label><input name="ref" type="checkbox" /><span>Provides Referrals</span></label></div>
			</div>
			<div class="right">
				<button class="btn waves-effect waves-light" type="submit" name="action">Add GP<i class="material-icons right">send</i></button>
			</div>
		</form>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
	<script>
var options = {};
$(document).ready(function(){
	var elems = document.querySelectorAll('select');
	var instances = M.FormSelect.init(elems, options);
});

//$('#add-gp').validate({
//	debug: true
//});
	</script>
</body>
</html>
