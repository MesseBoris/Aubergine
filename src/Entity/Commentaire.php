<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Ticket;
/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
	
	/**
	 * Get id
	 *
	 *@return integer
	 */
	public function getId()
    {
        return $this->id;
    }

     /**
	 * @ORM\Column(type="text", length=255)
	 */
	private $texte;
	
	/**
	 * Get texte
	 *
	 *@return string
	 */
	public function getTexte()
    {
        return $this->texte;
    }

	/**
	 * Set texte
	 *
	 *@param string $post
	 *
	 *@return Commentaire
	 */
    public function setTexte($texte)
    {
        $this->texte = $texte;
		
		return $this;
    }
	
	
	
	/**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticket", inversedBy="Ticket")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ticket;

    public function getTicket(): Ticket
    {
        return $this->ticket;
    }

    public function setTicket(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
}
