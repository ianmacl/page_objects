<?php

class ControlPanelPage extends BasePage
{

	private $locators = array(
		'menu' => 'link=Site',
		'logout_button' => 'link=Log out',
	);
	
	private $menuOptions = array(
		'UserManagerPage' => 'link=User Manager'
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
			case 'menu':
				return $this->driver->get_element($this->locators[$property])->get_text();
			default:
				return $this->$property;
		}
	}

	function wait_until_loaded()
	{
		$this->waitForElementAvailable($this->locators['menu']);
	}

	public function open_from_menu($page)
	{
		$this->driver->get_element($this->menuOptions[$page])->click();
		$resultPage = new $page;
		$resultPage->wait_until_loaded();
		return $resultPage;
	}
	
	public function open_user_manager()
	{
		$this->driver->get_element($this->locators['user_manager_button'])->click();
		$userManagerPage = new UserManagerPage();
		$userManagerPage->wait_until_loaded();
		return $userManagerPage;
	}

	public function logout()
	{
		$this->driver->get_element($this->locators['logout_button'])->click();
		$adminLoginPage = new AdminLoginPage();
		$adminLoginPage->wait_until_loaded();
		return $adminLoginPage;
	}
}
