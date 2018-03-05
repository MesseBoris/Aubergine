<?php
namespace App\Controller;

use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; //add this line to add usage of Route class.
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller
{

    /**
     * @Route("/Tickets") //add this comment to annotations
     */
    public function tickets()
    {
		$em = $this->getDoctrine()->getManager();
        $tickets = $em->getRepository(Ticket::class)->findAll();
        return $this->render("all.html.twig", ["tickets" => $tickets]);
    }

}