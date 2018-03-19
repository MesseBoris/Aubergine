<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface as UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
	private $username;
	
	/**
	 * Get username
	 *
	 *@return string
	 */
	public function getUsername()
    {
        return $this->username;
    }

	/**
	 * Set username
	 *
	 *@param string $username
	 *
	 *@return User
	 */
    public function setUsername($username)
    {
        $this->username = $username;
		
		return $this;
    }
	
	/**
	 * @ORM\Column(type="text", length=255)
	 */
	private $email;
	
	/**
	 * Get email
	 *
	 *@return string
	 */
	public function getEmail()
    {
        return $this->email;
    }

	/**
	 * Set email
	 *
	 *@param string $email
	 *
	 *@return User
	 */
    public function setEmail($email)
    {
        $this->email = $email;
		
		return $this;
    }
	
	/**
	 * @ORM\Column(type="text", length=255)
	 */
	private $password;
	
	/**
	 * Get password
	 *
	 *@return string
	 */
	public function getPassword()
    {
        return $this->password;
    }

	/**
	 * Set password
	 *
	 *@param string $password
	 *
	 *@return User
	 */
    public function setPassword($password)
    {
        $this->password = $password;
		
		return $this;
    }
	
	/**
     * @ORM\Column(type="json_array")
     */
    private $roles = ["ROLE_USER"];
	
	/**
	 * Get roles
	 *
	 *@return json_array
	 */
	public function getRoles()
    {
        return $this->roles;
    }
	
	/**
	 * Set roles
	 *
	 *@param json_array $roles
	 *
	 *@return User
	 */
    public function setRoles($roles)
    {
        $this->roles = $roles;
		
		return $this;
    }
	
	/**
	 * @ORM\Column(type="text", length=255)
	 */
	private $plainpassword;
	
	/**
	 * Get plainpassword
	 *
	 *@return string
	 */
	public function getPlainpassword()
    {
        return $this->plainpassword;
    }

	/**
	 * Set plainpassword
	 *
	 *@param string $plainpassword
	 *
	 *@return User
	 */
    public function setPlainpassword($plainpassword)
    {
        $this->plainpassword = $plainpassword;
		
		return $this;
    }
	
	public function getSalt() {
        return null;
    }
	
	public function addRole($role) {
        $this->roles[] = $role;
    }
    
    public function removeRole($role) {
        $index = array_search($role, $this->roles, true);
        if ($index !== false) {
            array_splice($this->roles, $index, 1);
        }
    }
	
	public function eraseCredentials() {
        $this->plainPassword=null;
    }
}
