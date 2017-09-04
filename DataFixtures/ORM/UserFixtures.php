<?php
namespace B4rb4ross4\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use B4rb4ross4\UserBundle\Entity\User;

/**
 * Class UserFixtures
 * @author Sven Lütje <sven.luetje@googlemail.com>
 */
class UserFixtures extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
{

  /**
   * @var ContainerInterface
   */
  private $container;

  public function setContainer(ContainerInterface $container = null)
  {
    $this->container = $container;
  }

  public function load(ObjectManager $manager)
  {
    //Create super admin
    $superAdmin = new User();
    $superAdmin->setUsername('superadmin');
    $superAdmin->setEmail('test@test.de');

    $password = $this->container->get('security.password_encoder')
                     ->encodePassword($superAdmin, 'test');
    $superAdmin->setPassword($password);

    $superAdmin->setRegisteredAt(new \DateTime());
    $superAdmin->setIsActive(true);
    $superAdmin->addRole('ROLE_USER');
    $superAdmin->addRole('ROLE_SUPER_ADMIN');

    $manager->persist($superAdmin);
    $manager->flush();

    $this->addReference('superadmin', $superAdmin);
  }
}