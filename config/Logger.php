<?php
class Logger {
    private $file;

    public function __construct($filename = "logs/app.log") {
        $this->file = $filename;
    }

    public function info($message) {
        $this->writeLog("INFO", $message);
    }

    public function error($message) {
        $this->writeLog("ERROR", $message);
    }

    public function security($message) {
        $this->writeLog("SECURITY", $message);
    }

    private function writeLog($level, $message) {
        date_default_timezone_set("America/Asuncion"); // Paraguay
        $date = date("Y-m-d H:i:s");
        $logMessage = "[$date] [$level] $message" . PHP_EOL;
        file_put_contents($this->file, $logMessage, FILE_APPEND | LOCK_EX);
    }
}