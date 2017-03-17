<?php
/**
 * Defines blueprints for error display
 */
interface ErrorDisplay {
	/**
	 * Displays error to screen.
	 * 
	 * @param Exception $exception
	 */
	function display(Exception $exception);
}