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

	var_dump($result);

	$result = $db->rawQuery("CREATE TABLE IF NOT EXISTS " . $prefix . "county (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name varchar(15) NOT NULL,
	primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

	var_dump($result);

	$result = $db->rawQuery("CREATE TABLE IF NOT EXISTS " . $prefix . "area (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	county INT(11) NOT NULL,
	primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

	var_dump($result);

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

	var_dump($result);

?>
