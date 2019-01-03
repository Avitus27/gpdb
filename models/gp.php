<?php

class gp extends dbObject {
	protected $dbTable = "gp";
	protected $primaryKey = "id";
	protected $dbFields = Array (
		'name' => Array('text', 'required'),
		'contact' => Array('text'),
		'address_line_one' => Array('text', 'required'),
		'address_area' => Array('int', 'required'),//relates to area table
		'latitude' => Array(),
		'longitude' => Array(),
		'trans_friendly' => Array(),
		'choice_friendly' => Array(),
		'medical_card_friendly' => Array(),
		'ready_to_refer => Array()'
	);
	protected $relations = Array (
		
	);
}



?>
