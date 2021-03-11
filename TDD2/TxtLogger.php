<?php

namespace TDD2;

class TxtLogger {

	public function __construct($file) {
		fopen($file, "w");
	}
}