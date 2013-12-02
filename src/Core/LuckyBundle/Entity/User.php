<?php

namespace Core\LuckyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Core\LuckyBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class User implements AdvancedUserInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $number_lucky_beggar
     *
     * @ORM\Column(name="number_lucky_beggar", type="integer", length=11, unique=true, nullable=true)
     */
    private $number_lucky_beggar;
	
    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=100, unique=true)
     */
    private $username;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=64, nullable=true)
     */
    private $password;

    /**
     * @var string $salt
     *
     * @ORM\Column(name="salt", type="string", length=32, nullable=true)
     */
    private $salt;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var boolean $isActive
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=true)
     */
     
    private $isActive;

    /**
     * @var boolean $isPrivileged
     *
     * @ORM\Column(name="isPrivileged", type="boolean")
     */
     
    private $isPrivileged;

    /**
     * @var \DateTime $createDate
     *
     * @ORM\Column(name="createDate", type="datetime")
     */
    private $createDate;

    /**
     * @var \DateTime $modifiedDate
     *
     * @ORM\Column(name="modifiedDate", type="datetime")
     */
    private $modifiedDate;

    public function __construct()
    {
        $this->isActive = false;
		$this->isPrivileged = false;
        $this->number_lucky_beggar = null;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number_lucky_beggar
     *
     * @param integer $number_lucky_beggar
     */
    public function setNumberLuckyBeggar($number_lucky_beggar)
    {
        $this->number_lucky_beggar = $number_lucky_beggar;
    }

    /**
     * Get number_lucky_beggar
     *
     * @return integer 
     */
    public function getNumberLuckyBeggar()
    {
        return $this->number_lucky_beggar;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
    	$this->username = $email;
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
	
    /**
     * Set isActive
     *
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    
    /**
     * Set isPrivileged
     *
     * @param boolean $isPrivileged
     */
    public function setIsPrivileged($isPrivileged)
    {
        $this->isPrivileged = $isPrivileged;
    }

    /**
     * Get isPrivileged
     *
     * @return boolean 
     */
    public function getIsPrivileged()
    {
        return $this->isPrivileged;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return AddressBook
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    
        return $this;
    }
    
	/**
	 * @ORM\prePersist
	 */
	public function setCreateDateValue()
	{
	    $this->createDate = new \DateTime();
	}

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

	/**
	 * @ORM\prePersist
	 * @ORM\PreUpdate
	 */
    public function preUpdateModifiedDate()
    {
        $this->modifiedDate = new \DateTime();
    }

    /**
     * Get modifiedDate
     *
     * @return \DateTime 
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }
	
	// Перегруженные методы AdvancedUserInterface для реализации блокировки пользователя по полю isActive
	public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }
    
    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }
    
    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }
}