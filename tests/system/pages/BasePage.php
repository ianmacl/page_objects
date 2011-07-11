<?php

require_once 'includes/WebDriverConnection.php';

class BasePage
{

	public static $string_timeout = "30000"; // 30 seconds

	// constructor

	function __construct()
	{
		$this->driver = WebDriverConnection::getInstance()->driver;
	}

	public function waitForElementAvailable($element)
	{
		for ($second = 0;; $second++)
		{
			if ($second >= 5)
			{
				throw new Exception("timeout for element " . $element . " present");
			}
			try
			{
				if ($this->driver->is_element_present($element))
					break;
			} catch (Exception $e)
			{
				
			}
			sleep(1);
		}
		for ($second;; $second++)
		{
			if ($second >= 5)
				throw new Exception("timeout for element " . $element . " visibility");
			try
			{
				if ($this->driver->get_element($element)->is_visible())
					break;
			} catch (Exception $e)
			{

			}
			sleep(1);
		}
	}

}

