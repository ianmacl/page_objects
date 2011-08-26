<?php

class ControlPanelPage extends BasePage
{

	private $locators = array(
		'menu' => 'link=Site',
		'logout_button' => 'link=Log out',
	);
	
	private $menuOptions = array(
		'UserManagerPage' => array('link=Users', 'link=User Manager'),
		'MyProfilePage' => array('link=Site', 'link=My Profile')
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
		$menuOption = $this->menuOptions[$page];
		print_r($menuOption);
		$this->driver->get_element($menuOption[0])->hover();
		sleep(3);
		//echo $menuOption[0]; die();
		if (count($menuOption) == 2) {
			$this->driver->get_element($menuOption[1])->click();
			echo $menuOption[1];
		} else {
			$this->driver->get_element($menuOption[1])->hover();
			$this->driver->get_element($menuOption[2])->click();
		}
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
