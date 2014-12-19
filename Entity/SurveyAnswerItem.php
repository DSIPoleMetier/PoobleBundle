<?php

namespace Lyon1\Bundle\PoobleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SurveyAnswerItem
 *
 * @ORM\Table(name="survey_answer_item")
 * @ORM\Entity
 */
class SurveyAnswerItem
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
     * @ORM\Column(name="value", type="string", length=10, nullable=true)
     */
    private $value;

    /**
     * @var SurveyAnswer
     *
     * @ORM\ManyToOne(targetEntity="SurveyAnswer",inversedBy="answerItems")
     * @ORM\JoinColumn(name="survey_answer_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $answer;

    /**
     * @var SurveyItem
     *
     * @ORM\ManyToOne(targetEntity="SurveyItem",inversedBy="answerItems")
     * @ORM\JoinColumn(name="survey_item_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $item;

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
     * Set value
     *
     * @param string $value
     * @return SurveyAnswerItem
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set answer
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswer $answer
     * @return SurveyAnswerItem
     */
    public function setAnswer(\Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswer $answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return \Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswer 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set item
     *
     * @param \Lyon1\Bundle\PoobleBundle\Entity\SurveyItem $item
     * @return SurveyAnswerItem
     */
    public function setItem(\Lyon1\Bundle\PoobleBundle\Entity\SurveyItem $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Lyon1\Bundle\PoobleBundle\Entity\SurveyItem 
     */
    public function getItem()
    {
        return $this->item;
    }
}
