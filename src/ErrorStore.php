<?php
interface ErrorStore {
	function store(Exception $exception);
}