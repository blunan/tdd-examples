<?php

namespace TDD2;

class TxtLogger {

	public function __construct($file) {
		fclose(fopen($file, "a"));
	}
}