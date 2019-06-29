<?php

class User {
	private $id;		// User ID
	private $name;		// Username
	private $phone;		// Phone Number
	private $number;    // Unique Secret Number

	private $level;     // User's Activity Level

	public function __construct() {
		// Empty constructor
	}

	public static function init(array $arr) {
		$instance = new self();
		$instance->id = $arr['id'];
		$instance->name = $arr['username'];
		$instance->phone = $arr['phone'];
		$instance->level = $arr['level'];
		$instance->number = $arr['usernum'];
		return $instance;
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function getNumber() {
		return $this->number;
	}

	public function getLevel() {
		return $this->level;
	}
}