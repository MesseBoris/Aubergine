<?php
namespace App\Controller;

use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use DateTime;
use App\Entity\Competence;
use App\Entity\Commentaire;
use App\Entity\Intervention;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route; //add this line to add usage of Route class.
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Form\CommentaireType;
use App\Form\TicketType;
use App\Form\InterventionType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class TicketController extends Controller
{

    /**
     * @Route("/ticket/all") //add this comment to annotations
     */
    public function ticket()
    {
		$em = $this->getDoctrine()->getManager();
		 $user=$this->getUser();
         $ticketes = $em->getRepository(Ticket::class)->findAll();
		 $tickets=[];
		 foreach($ticketes as $ticket)
		 {
			 if($ticket->getComp()==$user)
			 {
				 $tickets[]=$ticket;
			 }
		 }
        return $this->render("all.html.twig", ["tickets" => $tickets,'user'=>$user]);
    }
	
	
	public function redir($ticket)
	{
		$em = $this->getDoctrine()->getManager();
		$useres = $em->getRepository(User::class)->findAll();
		$users=[];
		foreach($useres as $user)
			foreach($user->getRoles() as $role)
				if($role=="ROLE_ADMIN")
					$users[]=$user;
		return $this->render("select.html.twig", ["ticket" => $ticket,'users'=>$users]);
	}
	
	
	public function redir2($ticket, $user)
    {
		$em = $this->getDoctrine()->getManager();
        $ticket = $em->getRepository(Ticket::class)->find($ticket);
		
		$temp=false;
		$ticket->updateNbRedir();
		if($ticket->getNbRedir<=3)
		{
			$comp = $em->getRepository(User::class)->find($user);
			foreach($comp->getRoles() as $role)
			{
				if($role==$ticket->getQualification())
					$temp=true;
			}
		}
		else
		{
			$comp = $em->getRepository(User::class)->find(1);
		}
		
		if($temp==false)
			$comp = $em->getRepository(User::class)->find(1);
		
		$ticket->setComp($comp);
		$comp->addTicket($ticket);
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
			$ticket->setNbRedir(0);
			$ticket->setUser($user);
			$em->persist($ticket);
			
			//Système recherche user capable de traiter
			$useres= $em->getRepository(User::class)->findAll();
			$users_enables=[];
			foreach ($useres as $usere)
			{
				foreach($usere->getRoles() as $role)
				{
					if($role == 'ROLE_ADMIN')
					{
						foreach($usere->getCompetences() as $comp)
							if($comp== $ticket->getQualification())
								$users_enables[]=$usere;
					}
				}
			}
			//affiliation ticket
			if($users_enables == null)
			{
				$ticket->setComp($em->getRepository(User::class)->find(1));
			}
			else
			{
				$temp=new User();
				$tempj=0;
				foreach($users_enables as $usere)
				{
					$i=0;
					if(null !== $usere->getTickets())
					foreach($usere->getTickets() as $tick)
					{
						$i++;
					}
					if($i>$tempj)
					{
						$temp=$usere;
						$tempj=$i;
					}
				}
				//enregistrement
				$temp->addTicket($ticket);
				$em->persist($temp);
				$ticket->setComp($temp);
				$em->persist($ticket);
			}
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
		 $em = $this->getDoctrine()->getManager();
		 $user=$this->getUser();
         $ticketes = $em->getRepository(Ticket::class)->findAll();
		 $tickets=[];
		 foreach($ticketes as $ticket)
		 {
			 if($ticket->getUser()==$user)
			 {
				 $tickets[]=$ticket;
			 }
		 }
		 
		 return $this->render("mesTickets.html.twig", ["tickets" => $tickets, "user"=>$user]);
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
	 
	 public function traiter($ticket,Request $request)
	 {
		$comm = new Intervention();
		$em = $this->getDoctrine()->getManager();
		
		$repository = $this->getDoctrine()->getRepository(Ticket::class);
		$ticket=$repository->find($ticket);
		
		$repository = $this->getDoctrine()->getRepository(Intervention::class);
		$comms=$repository->findBy(['ticket'=>$ticket]);
		
		$form = $this->createForm(InterventionType::class, $comm);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) 
		{
			$comm->setTicket($ticket);
			$em->persist($comm);
			$em->flush();
			return $this->redirectToRoute('app_ticket_fin',array('ticket'=>$ticket->getId()));
		}
		 return $this->render("commenter.html.twig", array('form' => $form->createView(),'comms'=>$comms));
	 }
	 
	 public function fin($ticket)
	 {
		$em = $this->getDoctrine()->getManager();
        $tickets = $em->getRepository(Ticket::class)->find($ticket);
		return $this->render("fin.html.twig",array('ticket'=>$tickets));
	 }
	 
	 
	 public function valider($ticket)
	 {
		$em = $this->getDoctrine()->getManager();
        $tickets = $em->getRepository(Ticket::class)->findAll();
		foreach($tickets as $ticke)
		{
			if($ticke->getId()==$ticket)
			{
				$ticke->setEtat(false);
				$ticke->setValidated(true);
				$em->persist($ticke);
				$em->flush();
			}
		}
        return $this->redirectToRoute('app_ticket_all');
	 }

}