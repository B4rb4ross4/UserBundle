<?php
namespace B4rb4ross4\UserBundle\Test;
use B4rb4ross4\UserBundle\Entity\User;

class UserCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

    // tests
    public function testConstruction(UnitTester $I)
    {
        $I->wantToTest('The default values after construction');
        $user = new User();

        $I->assertNull($user->getId());
        $I->assertEquals('', $user->getUsername());
        $I->assertEquals('', $user->getPassword());
        $I->assertEquals('', $user->getEmail());
        $I->assertFalse($user->getIsActive());
        $I->assertEquals([], $user->getRoles());
        $I->assertNull($user->getDisabledAt());
        $I->assertFalse($user->getIsExpired());
        $I->assertNull($user->getExpiredAt());
        $I->assertFalse($user->getIsLocked());
        $I->assertNull($user->getLockedAt());
        $I->assertFalse($user->getIsCredentialsExpired());
        $I->assertNull($user->getCredentialsExpiredAt());
        $I->assertNull($user->getLastLoginAt());
        $I->assertNull($user->getRegisteredAt());
        $I->assertNull($user->getUpdatedAt());
        $I->assertEquals(0, $user->getLoginAttempts());
        $I->assertNull($user->getLastLoginAttempt());
        $I->assertEmpty('', $user->getPlainPassword());
    }
}
