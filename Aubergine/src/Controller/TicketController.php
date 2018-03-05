<?php
namespace App\Controller;

use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; //add this line to add usage of Route class.
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller
{

    /**
     * @Route("/ticket/all") //add this comment to annotations
     */
    public function ticket()
    {
		$em = $this->getDoctrine()->getManager();
        $tickets = $em->getRepository(Ticket::class)->findAll();
        return $this->render("all.html.twig", ["tickets" => $tickets]);
    }
	
	/**
     * @Route("/ticket/add") //add this comment to annotations
     */
    public function add(Request $request, Ticket $ticket=null)
    {
		if($ticket ==null )
			$ticket = new Ticket();
		$form = $this->createFormBuilder($ticket)
			->add("poste", TextType::class)
			->add("description",Texttype::class)
			->add("save", SubmitType::class, ["label" => "créer ticket"])
			->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($ticket);
			$em->flush();
			return $this->redirectToRoute("app_ticket_all");
		}
		return $this->render("add.html.twig", ["form" => $form->createView()]);
	}
}