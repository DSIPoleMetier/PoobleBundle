<?php

namespace Lyon1\Bundle\PoobleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SurveyAnswer
 *
 * @ORM\Table(name="survey_answer")
 * @ORM\Entity
 */
class SurveyAnswer
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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var Survey
     *
     * @ORM\ManyToOne(targetEntity="Survey", inversedBy="answers")
     * @ORM\JoinColumn(name="survey_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $survey;

    /**
     * @var SurveyAnswerItems[]
     *
     * @ORM\OneToMany(targetEntity="SurveyAnswerItem", mappedBy="answer", cascade={"persist"})
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
     * @return SurveyAnswer
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return SurveyAnswer
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
     * Set survey
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\Survey $survey
     * @return SurveyAnswer
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
     * @return SurveyAnswer
     */
    public function addAnswerItem(\Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswerItem $answerItem)
    {
        $answerItem->setAnswer($this);
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
