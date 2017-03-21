<?php
require_once("ErrorRenderer.php");
require_once("ErrorReporter.php");

/**
 * Single point of entry for all uncaught errors inside application (incl. PHP errors)
 */
class ErrorHandler {
	private $reporters=array();
	private $renderer;
	
	/**
	 * Registers a storage medium for errors to be recorded into.
	 * 
	 * @param ErrorReporter $reporter Performs storage of error (eg: in logs or in database)
	 */
	public function addReporter(ErrorReporter $reporter) {
		$this->reporters[] = $reporter;
	}
	
	/**
	 * Registers an error display mechanism
	 * 
	 * @param ErrorRenderer $renderer Defines what clients will see while encountering an error. 
	 */
	public function setRenderer(ErrorRenderer $renderer) {
		$this->renderer = $renderer;
	}
	
	/**
	 * Handles errors by delegating to registered storage mediums (if any) then output using display method (if any)
	 * 
	 * @param Exception $e Encapsulates error information.
	 */
	public function handle(Exception $e) {
		foreach($this->reporters as $reporter) {
			$reporter->report($e);	
		}
		if($this->renderer) {
			$this->renderer->render($e);
		}
	}
}