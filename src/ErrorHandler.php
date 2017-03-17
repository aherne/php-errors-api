<?php
require_once("ErrorDisplay.php");
require_once("ErrorStore.php");

/**
 * Single point of entry for all uncaught errors inside application (incl. PHP errors)
 */
class ErrorHandler {
	private $storageMethods=array();
	private $displayMethod;
	
	/**
	 * Registers a storage medium for errors to be recorded into.
	 * 
	 * @param ErrorStore $storageMethod Performs storage of error (eg: in logs or in database)
	 */
	public function addStorage(ErrorStore $storageMethod) {
		$this->storageMethods[] = $storageMethod;
	}
	
	/**
	 * Registers an error display mechanism
	 * 
	 * @param ErrorDisplay $displayMethod Defines what clients will see while encountering an error. 
	 */
	public function setDisplay(ErrorDisplay $displayMethod) {
		$this->displayMethod = $displayMethod;
	}
	
	/**
	 * Handles errors by delegating to registered storage mediums (if any) then output using display method (if any)
	 * 
	 * @param Exception $e Encapsulates error information.
	 */
	public function handle(Exception $e) {
		foreach($this->storageMethods as $method) {
			$method->store($e);	
		}
		if($this->displayMethod) {
			$this->displayMethod->display($e);
		}
	}
}