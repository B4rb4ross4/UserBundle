<?php

namespace B4rb4ross4\UserBundle\Controller;

use B4rb4ross4\UserBundle\Entity\User;
use B4rb4ross4\UserBundle\Form\UserRegistrationType;
use B4rb4ross4\UserBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Translation\Translator;

/**
 * User controller.
 *
 */
class UserController extends Controller
{

  public function submenuEntries()
  {
    /** @var Translator $t */
    $t = $this->get('translator');

    return [
      'b4rb4ross4_user_profile' => $t->trans('user.profile'),
      'b4rb4ross4_user_list' => $t->trans('user.index.title'),
      'b4rb4ross4_user_create' => $t->trans('user.create.title'),
      'b4rb4ross4_user_logout' => $t->trans('user.action.logout'),
    ];
  }

  /**
   * Lists all User entities.
   *
   * @Route("/users", name="b4rb4ross4_user_list")
   * @Method("GET")
   */
  public function indexAction()
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    $em = $this->getDoctrine()->getManager();

    $users = $em->getRepository('B4rb4ross4UserBundle:User')->findAll();

    $this->get('twig')->addGlobal('submenuEntries', $this->submenuEntries());

    return $this->render('B4rb4ross4UserBundle:User:index.html.twig', array(
      'users' => $users,
    ));
  }

  /**
   * Creates a new User entity.
   *
   * @Route("/user/create", name="b4rb4ross4_user_create")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request)
  {
    $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

    /** @var Translator $t */
    $t = $this->get('translator');

    $user = new User();
    $form = $this->createForm(UserRegistrationType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $password = $this->get('security.password_encoder')
        ->encodePassword($user, $user->getPlainPassword());
      $user->setPassword($password);
      $user->setRegisteredAt(new \DateTime());
      $user->addRole('ROLE_USER');

      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();

      $this->addFlash(
        'success',
        $t->trans('user.action.create.success')
      );

      return $this->redirectToRoute('b4rb4ross4_user_show', array('id' => $user->getId()));
    }

    $this->get('twig')->addGlobal('submenuEntries', $this->submenuEntries());

    return $this->render('B4rb4ross4UserBundle:User:create.html.twig', array(
      'user' => $user,
      'form' => $form->createView(),
    ));
  }

  /**
   * Finds and displays the User entity of the currently logged in User.
   *
   * @Route("/user/profile", name="b4rb4ross4_user_profile")
   * @Method("GET")
   */
  public function profileAction(Request $request)
  {
    $this->denyAccessUnlessGranted('ROLE_USER');

    $user = $this->getUser();

    $this->get('twig')->addGlobal('submenuEntries', $this->submenuEntries());

    return $this->render('B4rb4ross4UserBundle:User:show.html.twig', array(
      'user' => $user,
    ));
  }

  /**
   * Finds and displays a User entity.
   *
   * @Route("/user/{id}", name="b4rb4ross4_user_show")
   * @Method("GET")
   */
  public function showAction(User $user)
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    $this->get('twig')->addGlobal('submenuEntries', $this->submenuEntries());

    return $this->render('B4rb4ross4UserBundle:User:show.html.twig', array(
      'user' => $user,
    ));
  }

  /**
   * Displays a form to edit an existing User entity.
   *
   * @Route("/user/{id}/edit", name="b4rb4ross4_user_edit")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, User $user)
  {
    $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

    /** @var Translator $t */
    $t = $this->get('translator');

    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();

      $user->setUpdatedAt(new \DateTime());

      $this->addFlash(
        'success',
        $t->trans('user.action.edit.success')
      );

      return $this->redirectToRoute('b4rb4ross4_user_show', array('id' => $user->getId()));
    }

    $this->get('twig')->addGlobal('submenuEntries', $this->submenuEntries());

    return $this->render('B4rb4ross4UserBundle:User:edit.html.twig', array(
      'user' => $user,
      'form' => $form->createView(),
    ));
  }

  /**
   * Deletes a User entity.
   *
   * @Route("/user/{id}", name="b4rb4ross4_user_delete")
   * @Method("DELETE")
   */
  public function deleteAction(Request $request, User $user)
  {
    $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

    $form = $this->createDeleteForm($user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($user);
      $em->flush();
    }

    return $this->redirectToRoute('b4rb4ross_user_list');
  }

  /**
   * Log a user in
   *
   * @Route("/login", name="b4rb4ross4_user_login")
   * @Method({"GET", "POST"})
   */
  public function loginAction(Request $request)
  {
    /** @var \Symfony\Component\Security\Http\Authentication\AuthenticationUtils $authenticationUtils */
    $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    if (!empty($error)) {
      $this->addFlash(
        'error',
        $error->getMessage()
      );
    }

    return $this->render(
      'B4rb4ross4UserBundle:User:login.html.twig',
      array(
        // last username entered by the user
        'last_username' => $lastUsername,
      )
    );
  }

  /**
   * Log a user out
   *
   * @Route("/logout", name="b4rb4ross4_user_logout")
   * @Method({"GET"})
   */
  public function logoutAction(Request $request)
  {
    throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
  }

  /**
   * Creates a form to delete a User entity.
   *
   * @param User $user The User entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(User $user)
  {
    $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

    return $this->createFormBuilder()
      ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
      ->setMethod('DELETE')
      ->getForm();
  }
}
