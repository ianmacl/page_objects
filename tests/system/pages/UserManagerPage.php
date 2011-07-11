<?php

class UserManagerPage extends BasePage
{

	private $locators = array(
		"page_title" => "css=.pagetitle h2",
		'filter_search' => 'filter_search',
		'new_user_button' => 'link=New',
		'search_button' => '//button[@type=\'submit\']',
		'checkbox' => 'cb',
		'delete_button' => 'link=Delete'
	);

	function __set($property, $value)
	{
		switch ($property)
		{
			// cases can be stacked so all the 'text' ones here
			case 'filter_search':
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
			case 'page_title':
				return $this->driver->get_element($this->locators[$property])->get_text();
			default:
				return $this->$property;
		}
	}

	function wait_until_loaded()
	{
		$this->waitForElementAvailable($this->locators['page_title']);
	}

	public function delete_user($username)
	{
		$this->search_user($username);
		$this->toggle_checkbox(0);
		$this->driver->get_element($this->locators['delete_button'])->click();
		$this->wait_until_loaded();
		return $this;
	}

	public function toggle_checkbox($number)
	{
		$this->driver->get_element($this->locators['checkbox'].$number)->click();
		return $this;
	}
	
	public function search_user($username)
	{
		$this->filter_search = $username;
		$this->driver->get_element($this->locators['search_button'])->click();
		sleep(13);
		$this->wait_until_loaded();

		return $this;
	}
	
	public function new_user()
	{
		$this->driver->get_element($this->locators['new_user_button'])->click();
		$userEditPage = new UserEditPage();
		$userEditPage->wait_until_loaded();
		return $userEditPage;
	}

}
