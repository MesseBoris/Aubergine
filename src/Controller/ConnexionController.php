<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\UserType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnexionController extends Controller
{

	/**
     * @Route("/public") //add this comment to annotations
     */
	public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
	{
		// 1) build the form
		$user = new User();
		$form = $this->createForm(UserType::class, $user);
		

		// 2) handle the submit (will only happen on POST)
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {

			// 3) Encode the password (you could also do this via Doctrine listener)
			$password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
			$user->setPassword($password);

			$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

			// ... do any other work - like sending them an email, etc
			// maybe set a "flash" success message for the user

			return $this->redirect('acceuil');
		}

		return $this->render(
			'registration/register.html.twig',
			array('form' => $form->createView())
		);
	}
	
	public function login(Request $request, AuthenticationUtils $authUtils)
	{
		// get the login error if there is one
		$error = $authUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $authUtils->getLastUsername();

		return $this->render('security/login.html.twig', array(
			'last_username' => $lastUsername,
			'error'         => $error,
		));

	}
	
	public function redir()
	{
		return $this->redirectToRoute("app_ticket_co");
	}

}