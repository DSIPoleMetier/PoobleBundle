<?php

namespace Lyon1\Bundle\PoobleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SurveyItem
 *
 * @ORM\Table(name="survey_item")
 * @ORM\Entity
 */
class SurveyItem
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var Survey
     *
     * @ORM\ManyToOne(targetEntity="Survey", inversedBy="items", cascade={"remove"})
     * @ORM\JoinColumn(name="survey_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $survey;

    /**
     * @var SurveyAnswerItems[]
     *
     * @ORM\OneToMany(targetEntity="SurveyAnswerItem", mappedBy="item")
     */
    private $answerItems;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answerItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return SurveyItem
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
     * Set description
     *
     * @param string $description
     * @return SurveyItem
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
     * Set survey
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\Survey $survey
     * @return SurveyItem
     */
    public function setSurvey(\Lyon1\Bundle\PoobleBundle\Entity\Survey $survey = null)
    {
        $this->survey = $survey;

        return $this;
    }

    /**
     * Get survey
     *
     * @return \Lyon1\Bundle\PoobleBundle\Entity\Survey 
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * Add answerItem
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswerItem $answerItem
     * @return SurveyItem
     */
    public function addAnswerItem(\Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswerItem $answerItem)
    {
        $this->answerItems[] = $answerItem;

        return $this;
    }

    /**
     * Remove answerItem
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswerItem $answerItem
     */
    public function removeAnswerItem(\Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswerItem $answerItem)
    {
        $this->answerItems->removeElement($answerItem);
    }

    /**
     * Get answerItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswerItems()
    {
        return $this->answerItems;
    }
}
