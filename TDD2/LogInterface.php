<?

namespace TDD2;

interface Log {

	// Writes a message to the log
	public function writeLog($message);

	// Reads the whole log
	public function readLog($message);

	// Writes a message with a prefix tag
	public function writeLogWithTag($tag , $message);

	// Reads all logs for tag
	public function readLogWithTag($tag);
}

?>