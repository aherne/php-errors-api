<?php
/**
 * Defines blueprint for error reporting 
 */
interface ErrorReporter {
	/**
	 * Reports error to a storage medium.
	 * 
	 * @param Exception|Throwable $exception
	 */
	function report($exception);
}