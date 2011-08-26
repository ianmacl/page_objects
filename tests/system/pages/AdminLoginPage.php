<?php

class AdminLoginPage extends BasePage
{

	private $locators = array(
		"username" => "name=username",
		"password" => "name=passwd",
		"submit_button" => "link=Log in",
		"error_message" => "css=#system-message li"
	);

	function __set($property, $value)
	{
		switch ($property)
		{
			// cases can be stacked so all the 'text' ones here
			case "username":
			case "password":
				$element = $this->driver->get_element($this->locators[$property]);
				$element->clear();
				$element->send_keys($value);
				break;
			// if there were other types of elements like checks and selects
			// there would be another stack of cases here
			default:
				$this->$property = $value;
		}
	}

	function __get($property)
	{
		switch ($property)
		{
			case 'error_message':
				return $this->driver->get_element($this->locators[$property])->get_text();
			default:
				return $this->$property;
		}
	}

	function wait_until_loaded()
	{
		$this->waitForElementAvailable($this->locators['username']);
	}

	function open_default_base_url()
	{
		$this->driver->load(SiteSettings::$url . 'administrator');
		//$this->driver->load('http://google.com');
		//$element = $this->driver->get_element('tag name=div');
	}

	function login_success($username = null, $password = null)
	{
		if (is_null($username)) {
			$username = SiteSettings::$username;
			$password = SiteSettings::$password;
		}
		$this->username = $username;
		$this->password = $password;
		
		$this->driver->get_element($this->locators['submit_button'])->click();
		$controlPanelPage = new ControlPanelPage();
		$controlPanelPage->wait_until_loaded();
		return $controlPanelPage;
	}

	function login_failed()
	{
		$this->driver->get_element($this->locators['submit_button'])->click();
		$this->wait_until_loaded();
		return $this;
	}

}
