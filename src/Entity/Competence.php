<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetenceRepository")
 */
class Competence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }
	
	/**
	 * @ORM\Column(type="text", length=255)
	 */
	private $tipe;
	
	/**
	 * Get type
	 *
	 *@return string
	 */
	public function getTipe()
    {
        return $this->type;
    }

	/**
	 * Set type
	 *
	 *@param string $tipe
	 *
	 *@return Competence
	 */
    public function setTipe($tipe)
    {
        $this->tipe = $tipe;
		
		return $this;
    }
	
	/**
	 * @ORM\Column(type="text", length=255)
	 */
	private $libelle;
	
	/**
	 * Get libelle
	 *
	 *@return string
	 */
	public function getLibelle()
    {
        return $this->libelle;
    }

	/**
	 * Set Libelle
	 *
	 *@param string $libelle
	 *
	 *@return Competence
	 */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
		
		return $this;
    }
	/**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="User",cascade={"persist"})
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
