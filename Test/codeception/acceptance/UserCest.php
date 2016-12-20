<?php
namespace UserBundle;

use UserBundle\AcceptanceTester;

class UserCest
{
  public function _before(AcceptanceTester $I)
  {
  }

  public function _after(AcceptanceTester $I)
  {
  }

  // tests
  public function loginTest(AcceptanceTester $I)
  {
    $I->amGoingTo('visit the login page and log in');
    $I->amOnPage('/login');
    $I->expect("I'm on the login page");
    $I->see('Login');
    $I->fillField('_username', 'admin');
    $I->fillField('_password', 'test');
    $I->click('form button[type=submit]');
    $I->seeCurrentUrlEquals('/app_dev.php/');
    $I->expect("I'm on the dashboard");
    $I->see('Dashboard');
  }

  public function logoutTest(AcceptanceTester $I)
  {
    $I->amGoingTo('visit the login page and log in and then log out again');
    $I->amOnPage('/login');
    $I->fillField('_username', 'admin');
    $I->fillField('_password', 'test');
    $I->click('form button[type=submit]');
    $I->see('User', '#user-menu');
    $I->click("#user-menu");
    $I->see('Logout', '#logout');
    $I->click("#logout");
    $I->expect("I'm on the login page");
    $I->see('Login');
  }
}
