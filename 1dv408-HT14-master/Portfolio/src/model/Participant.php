<?php

namespace model;

class Participant {
	private $uniqueKey;
	private $name;

	public function __construct($uniqueKey, $name) {
		$this->uniqueKey = $uniqueKey;
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function getUnique() {
		return $this->uniqueKey;
	}
}