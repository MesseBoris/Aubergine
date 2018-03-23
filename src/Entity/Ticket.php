<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Commentaire;
use App\Entity\User;

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
	
	/**
	 * @ORM\Column(type="text", length=255, nullable=true)
	 */
	private $qualification;
	
	/**
	 * Get qualification
	 *
	 *@return string
	 */
	public function getQualification()
    {
        return $this->qualification;
    }

	/**
	 * Set qualification
	 *
	 *@param string $qualification
	 *
	 *@return Ticket
	 */
    public function setQualification($qual)
    {
        $this->qualification = $qual;
		
		return $this;
    }
	
	
	
	/**
	 * @ORM\Column(type="boolean",nullable=false)
	 */
	private $etat;
	
	/**
	 * Get etat
	 *@return bool
	 */
	public function getEtat()
    {
        return $this->etat;
    }
	
	

	/**
	 * Set etat
	 *
	 *@param bool $etat
	 *
	 *@return Ticket
	 */
    public function setEtat($etat)
    {
        $this->etat = $etat;
		
		return $this;
    }
	
	/**
	 * 
	 * @ORM\Column(type="datetime")
	 */
	protected $releaseOn;

	/**
	* Get releaseOn
	* @return date
	*/

	public function getReleaseOn(){
			return $this->releaseOn;
	}

	/**
	* Set releaseOn
	* @param date $releaseOn 
	* @return Ticket
	*/

	public function setReleaseOn($releaseOn){
			$this ->releaseOn = $releaseOn;
	}
	
	/**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="User")
     * @ORM\JoinColumn(nullable=true)
     */
   private $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
	
}
