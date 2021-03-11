<?

namespace TDD2;

interface Log {

	// Writes a message to the log
	public function writeLog($message): void;

	// Reads the whole log
	public function readLog(): String;

	// Writes a message with a prefix tag
	public function writeLogWithTag($tag , $message): void;

	// Reads all logs for tag
	public function readLogWithTag($tag): String;
}

?>