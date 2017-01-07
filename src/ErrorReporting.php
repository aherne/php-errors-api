<?php
/**
 * Implements error reporting. Must be extended to provide action to perform when an error is encountered (store, display).
 */
abstract class ErrorReporting {
	protected $exception;
	
	/**
	 * Creates an error reporting instance.
	 * 
	 * @param Exception $exception
	 */
	public function __construct($exception) {
		$this->exception = $exception;
		$this->store();
		$this->display();
	}
	
	/**
	 * Reports error to a storage medium (database, log, mail).
	 */
	protected abstract function store();
	
	/**
	 * Displays response following error.
	 */
	protected abstract function display();
}