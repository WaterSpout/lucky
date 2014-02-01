<?php

namespace Core\LuckyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity()
 * @ORM\Table(name="wclasses")
 */
class Wclass
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = "2",
     *     max = "150"
     * )
     * @ORM\Column(type="string", length=150)
     *
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Race", inversedBy="wclasses")
     * @ORM\JoinTable(name="wclass_races")
     */
    protected $races;

    public function __construct()
    {
        $this->races = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Wclass
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add races
     *
     * @param \Core\LuckyBundle\Entity\Race $races
     * @return Wclass
     */
    public function addRace(\Core\LuckyBundle\Entity\Race $races)
    {
        $this->races[] = $races;
    
        return $this;
    }

    /**
     * Remove races
     *
     * @param \Core\LuckyBundle\Entity\Race $races
     */
    public function removeRace(\Core\LuckyBundle\Entity\Race $races)
    {
        $this->races->removeElement($races);
    }

    /**
     * Get races
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRaces()
    {
        return $this->races;
    }
}