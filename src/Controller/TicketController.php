<?php
namespace App\Controller;

use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use DateTime;
use App\Entity\Commentaire;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route; //add this line to add usage of Route class.
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Form\CommentaireType;
use App\Form\TicketType;
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
     * @Route("/") //add this comment to annotations
     */
	public function redir()
    {
		return $this->redirectToRoute("index");
    }
	
	/**
     * @Route("/logout") //add this comment to annotations
     */
	public function logout()
    {
		return $this->redirectToRoute("acceuil");
    }
	
	/**
     * @Route("/ticket/add") //add this comment to annotations
     */
    public function add(Request $request, Ticket $ticket=null)
    {
		$user = $this->getUser();
		if($ticket ==null )
			$ticket = new Ticket();
		
		$em = $this->getDoctrine()->getManager();
		
		$form = $this->createForm(TicketType::class, $ticket);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$ticket->setReleaseOn(new DateTime());
			$ticket->setEtat(true);
			$ticket->setValidated(false);
			$ticket->setUser($user);
			$em->persist($ticket);
			$em->flush();
			return $this->redirectToRoute("app_ticket_all");
		}
		return $this->render("add.html.twig", ["form" => $form->createView()]);
	}
	
	/**
     * @Route("/acceuil") //add this comment to annotations
     */
	 public function acceuil()
	 {
		 return $this->render("acceuil.html.twig");
	 }
	 
	 /**
     * @Route("/ticket/me") //add this comment to annotations
     */
	 public function mesTickets()
	 {
		 return $this->render("mesTickets.html.twig");
	 }
	 
	 /**
     * @Route("/ticket/stats") //add this comment to annotations
     */
	 public function stats()
	 {
		 return $this->render("stats.html.twig");
	 }
	 
	 /**
     * @Route("/ticket/clore/{ticket}") //add this comment to annotations
     */
	 public function clore($ticket)
	 {
		$em = $this->getDoctrine()->getManager();
        $tickets = $em->getRepository(Ticket::class)->findAll();
		foreach($tickets as $ticke)
		{
			if($ticke->getId()==$ticket)
			{
				$ticke->setEtat(false);
				$em->persist($ticke);
				$em->flush();
			}
		}
        return $this->redirectToRoute('app_ticket_all');
	 }
	 
	 /**
     * @Route("/ticket/commenter/{ticket}") //add this comment to annotations
     */
	 public function commenter($ticket,Request $request)
	 {
		$comm = new Commentaire();
		$em = $this->getDoctrine()->getManager();
		
		$repository = $this->getDoctrine()->getRepository(Ticket::class);
		$ticket=$repository->find($ticket);
		
		$repository = $this->getDoctrine()->getRepository(Commentaire::class);
		$comms=$repository->findBy(['ticket'=>$ticket]);
		
		$form = $this->createForm(CommentaireType::class, $comm);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) 
		{
			$comm->setTicket($ticket);
			$em->persist($comm);
			$em->flush();
			return $this->redirectToRoute('app_ticket_commenter',array('ticket'=>$ticket->getId()));
		}
		 return $this->render("commenter.html.twig", array('form' => $form->createView(),'comms'=>$comms));
	 }
	 

}