<?php
namespace B4rb4ross4\Bundle\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

/**
 * Class LoadUserData
 * @author Sven Lütje <sven.luetje@googlemail.com>
 */
class LoadUserData implements FixtureInterface, ContainerAwareInterface
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
    $userAdmin = new User();
    $userAdmin->setUsername('admin');
    $userAdmin->setEmail('test@test.de');

    $password = $this->container->get('security.password_encoder')
                     ->encodePassword($userAdmin, 'test');
    $userAdmin->setPassword($password);

    $userAdmin->setRegisteredAt(new \DateTime());
    $userAdmin->setIsActive(true);
    $userAdmin->addRole('ROLE_USER');
    $userAdmin->addRole('ROLE_SUPER_ADMIN');

    $manager->persist($userAdmin);
    $manager->flush();
  }
}