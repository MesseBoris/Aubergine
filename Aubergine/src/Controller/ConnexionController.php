<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ConnexionController extends Controller
{

	/**
     * @Route("/", name="Connexion") //add this comment to annotations
     */
public function Display()
{

	return new Response(
		"<html><body><h1>Connexion</h1></body></html>"
	);
}

}