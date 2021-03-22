<!DOCTYPE html>
<html style="height:100%">
<head>
	<title>GPDB</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css" media="screen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../styles/style.css">
</head>
<body class="container" style="height:98%">
<?php
	require_once(__DIR__."/../../vendor/autoload.php"); // Loads anything that's been added via composer

	$dotenv = new Dotenv\Dotenv(__DIR__."/../../"); // for .env
	$dotenv->load();
	$dotenv->required(['DB_HOST', 'DB_USER', 'DB_PASS', 'DB_BASE', 'DB_PREFIX', 'GOOGLE_API_KEY']);

	$host = $_ENV['DB_HOST'];
	$database = $_ENV['DB_BASE'];
	$user = $_ENV['DB_USER'];
	$pass = $_ENV['DB_PASS'];
	$prefix = $_ENV['DB_PREFIX'];
	$db = new MysqliDb($host, $user, $pass, $database);
	$db->setPrefix($prefix);

	$result = $db->rawQuery("DROP TABLE IF EXISTS " . $prefix . "area, " . $prefix . "county, " . $prefix . "gp;");

	// var_dump($result);

	$result = $db->rawQuery("CREATE TABLE IF NOT EXISTS " . $prefix . "county (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name varchar(15) NOT NULL,
	primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

	// var_dump($result);

	$result = $db->rawQuery("CREATE TABLE IF NOT EXISTS " . $prefix . "area (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	county INT(11) NOT NULL,
	primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

	// var_dump($result);

	$result = $db->rawQuery("CREATE TABLE IF NOT EXISTS " . $prefix . "gp (
	id int(11) NOT NULL,
	name tinytext NOT NULL,
	contact tinytext,
	address_line_one tinytext NOT NULL,
	address_area int(11) NOT NULL,
	latitude decimal(10,7) NOT NULL,
	longitude decimal(10,7) NOT NULL,
	trans_friendly tinyint(1) NOT NULL,
	choice_friendly tinyint(1) NOT NULL,
	medical_card_friendly tinyint(1) NOT NULL,
	ready_to_refer tinyint(1) NOT NULL,
	primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

	// var_dump($result);
// add users tables
?>

Would you like to create an admin account? This account will be auto-verified. You can add more accounts to the admin group after <a href="../register.php">creating them</a>.
<form class="col s12" action="install/createAdmin.php" method="post">
<div class="row">
                                <div class="input-field col s12">
                                        <input id="user" name="user" type="text" required="required">
                                        <label for="user">Username</label>
                                </div>
                        </div>
                        <div class="row">
                                <div class="input-field col s12">
                                        <input id="email" name="email" type="email" required="required" class="validate">
                                        <label for="email">Email</label>
                                </div>
                        </div>
                        <div class="row">
                                <div class="input-field col s12">
                                        <input id="pass" name="pass" type="password" required="required">
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
                                <button class="btn waves-effect waves-light" type="submit" name="action">Create Admin<i class="material-icons right">send</i></button>
                        </div>
                </form>
</body>
</html>
