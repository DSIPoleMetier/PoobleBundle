<?php

namespace Lyon1\Bundle\PoobleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SurveyCategory
 *
 * @ORM\Table(name="survey_category")
 * @ORM\Entity
 */
class SurveyCategory
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
     * @ORM\Column(name="name", type="string", length=128)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=128)
     */
    private $type;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Survey", mappedBy="category")
     */
    private $surveys;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->surveys = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * To string
     */
    public function __toString()
    {
        return $this->getName();
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
     * @return SurveyCategory
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
     * Set type
     *
     * @param string $type
     * @return SurveyCategory
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add survey
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\Survey $survey
     * @return SurveyCategory
     */
    public function addSurvey(\Lyon1\Bundle\PoobleBundle\Entity\Survey $survey)
    {
        $this->surveys[] = $survey;

        return $this;
    }

    /**
     * Remove survey
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\Survey $survey
     */
    public function removeSurvey(\Lyon1\Bundle\PoobleBundle\Entity\Survey $survey)
    {
        $this->surveys->removeElement($survey);
    }

    /**
     * Get surveys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSurveys()
    {
        return $this->surveys;
    }
}
