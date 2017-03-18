<?php
/**
 * Defines blueprint for error display
 */
interface ErrorRenderer {
	/**
	 * Renders error to screen.
	 * 
	 * @param Exception $exception
	 */
	function render(Exception $exception);
}