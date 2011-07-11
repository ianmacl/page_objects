<?php

require_once 'WebDriverConnection.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Bootstrap.php';

abstract class JoomlaTestCase extends PHPUnit_Framework_TestCase {

  public function setUp() {
      $this->verificationErrors = array();
      
      $this->driver = WebDriverConnection::getInstance()->driver;
      //$this->driver->start();
      //$this->selenium->windowMaximize();
  }

  public function tearDown()
  {
      $this->driver->delete_all_cookies();
      if (count($this->verificationErrors) != 0)
      {
        $this->fail(implode("\n", $this->verificationErrors));
      }
  }
}
