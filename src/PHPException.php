<?php
error_reporting(E_ALL);

/**
 * Exception caught automatically when a PHP error is encountered.
 */
class PHPException extends Exception {
	
	/**
	 * Class name to which error handling will be delegated.
	 * 
	 * @var ErrorHandler $strErrorHandlerClass
	 */
	protected static $objErrorHandler;
	

	/**
	 * Sets name of class to which error handling will be delegated.
	 * 
	 * @param string $strClassName
	 */
	public static function setErrorHandler(ErrorHandler $objErrorHandler) {
		self::$objErrorHandler = $objErrorHandler;
	}
	
	/**
	 * Function called automatically when a non-fatal PHP error is encountered.
	 * 
	 * @param integer $intErrorNumber
	 * @param string $strMessage
	 * @param string $strFile
	 * @param integer $intLine
	 */
	public static function nonFatalError($intErrorNumber, $strMessage, $strFile, $intLine) {
		$e = new self($strMessage, $intErrorNumber);
		$e->line = $intLine;
	    $e->file = $strFile;
	    if(!self::$objErrorHandler) die($strMessage);
	    self::$objErrorHandler->handle($e);
	   	die(); // prevents double-reporting if exception is caught
	}
	
	/**
	 * Function called automatically when a fatal PHP error is encountered.
	 */
	public static function fatalError() {
		$tblError = error_get_last();
		if(sizeof($tblError)) {
			$e = new self($tblError['message'],0);
			$e->line = $tblError['line'];
			$e->file = $tblError['file'];
			if(!self::$objErrorHandler) die($tblError['message']);
			self::$objErrorHandler->handle($e);
		}
	}
}

set_error_handler(array("PHPException", "nonFatalError"), E_ALL);
register_shutdown_function('PHPException::fatalError');