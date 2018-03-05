<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
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
	private $poste;
	
	/**
	 * Get poste
	 *
	 *@return string
	 */
	public function getPoste()
    {
        return $this->poste;
    }

	/**
	 * Set post
	 *
	 *@param string $post
	 *
	 *@return Ticket
	 */
    public function setPoste($poste)
    {
        $this->poste = $poste;
		
		return $this;
    }
	
	/**
	 * @ORM\Column(type="text", length=255, nullable=true)
	 */
	private $description;
	
	/**
	 * Get description
	 *
	 *@return string
	 */
	public function getDescription()
    {
        return $this->description;
    }

	/**
	 * Set description
	 *
	 *@param string $description
	 *
	 *@return Ticket
	 */
    public function setDescription($poste)
    {
        $this->description = $poste;
		
		return $this;
    }

}
