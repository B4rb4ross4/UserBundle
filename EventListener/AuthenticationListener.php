<?php
namespace B4rb4ross4\UserBundle\EventListener;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use B4rb4ross4\UserBundle\Entity\User;
use B4rb4ross4\UserBundle\Repository\UserRepository;

/**
 * Class AuthenticationListener
 * @author Sven Lütje <sven.luetje@googlemail.com>
 */
class AuthenticationListener implements EventSubscriberInterface
{

  /**
   * @var \Symfony\Component\DependencyInjection\Container
   */
  private $container;


  public function __construct(Container $container)
  {
    $this->container = $container;
  }

  /**
   * getSubscribedEvents
   *
   * @author 	Joe Sexton <joe@webtipblog.com>
   * @return 	array
   */
  public static function getSubscribedEvents()
  {
    return array(
      AuthenticationEvents::AUTHENTICATION_FAILURE => 'onAuthenticationFailure',
      'security.interactive_login' => 'onLoginSuccess',
    );
  }


  public function onAuthenticationFailure( AuthenticationFailureEvent $event )
  {
    $token = $event->getAuthenticationToken();

    /** @var User $user */
    $userName = $token->getUsername();

    $em=$this->container->get('doctrine.orm.entity_manager');
    /** @var UserRepository $repo */
    $repo = $em->getRepository('B4rb4ross4UserBundle:User');
    $user = $repo->loadUserByUsername($userName);

    if($user !== null)
    {
      $user->setLastLoginAttempt(new \DateTime());
      $user->setLoginAttempts($user->getLoginAttempts() + 1);

      if($user->getLoginAttempts() > 3)
      {
        $user->setIsLocked(true);
        $user->setLockedAt(new \DateTime());
      }

      $em->persist($user);
      $em->flush();
    }
  }


  public function onLoginSuccess( InteractiveLoginEvent $event )
  {
    $token = $event->getAuthenticationToken();

    /** @var User $user */
    $user=$token->getUser();

    if($user instanceof UserInterface)
    {
      $user->setLastLoginAt(new \DateTime());

      //reset login attempts if user is not locked
      if(!$user->getIsLocked())
      {
        $user->setLoginAttempts(0);
        $user->setLastLoginAttempt(null);
      }

      $em=$this->container->get('doctrine.orm.entity_manager');

      $em->persist($user);
      $em->flush();
    }
  }
}