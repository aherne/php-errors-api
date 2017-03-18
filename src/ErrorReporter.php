<?php
/**
 * Defines blueprint for error reporting 
 */
interface ErrorReporter {
	/**
	 * Reports error to a storage medium.
	 * 
	 * @param Exception $exception
	 */
	function report(Exception $exception);
}