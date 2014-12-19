<?php

namespace Lyon1\Bundle\PoobleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Survey
 *
 * @ORM\Table(name="survey")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Survey
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

     /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=32, unique=true)
     */
    private $token;

    /**
     * @var SurveyCategory
     *
     * @ORM\ManyToOne(targetEntity="SurveyCategory", inversedBy="surveys")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var SurveyItems[]
     *
     * @ORM\OneToMany(targetEntity="SurveyItem", mappedBy="survey", cascade={"all"})
     */
    private $items;

    /**
     * @var SurveyAnswer[]
     *
     * @ORM\OneToMany(targetEntity="SurveyAnswer", mappedBy="survey")
     */
    private $answers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function onCreate()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function onUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
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
     * @return Survey
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
     * Set location
     *
     * @param string $location
     * @return Survey
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Survey
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Survey
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Survey
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set category
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\SurveyCategory $category
     * @return Survey
     */
    public function setCategory(\Lyon1\Bundle\PoobleBundle\Entity\SurveyCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Lyon1\Bundle\PoobleBundle\Entity\SurveyCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add item
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\SurveyItem $item
     * @return Survey
     */
    public function addItem(\Lyon1\Bundle\PoobleBundle\Entity\SurveyItem $item)
    {
        $item->setSurvey($this);
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\SurveyItem $item
     */
    public function removeItem(\Lyon1\Bundle\PoobleBundle\Entity\SurveyItem $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Add answer
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswer $answer
     * @return Survey
     */
    public function addAnswer(\Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswer $answer
     */
    public function removeAnswer(\Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Survey
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }
}
