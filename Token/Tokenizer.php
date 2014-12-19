<?php

namespace Lyon1\Bundle\PoobleBundle\Token;

use Lyon1\Bundle\PoobleBundle\Entity\Survey;

class Tokenizer
{
    private $secret;

    public function __construct($secret)
    {        
        $this->secret = $secret;
    }

    public function generateToken(Survey $survey)
    {
        $date = new \DateTime();        
        
        return md5($this->secret.$date->format('Ymd H:i:s:u').$survey->getName());
    }
}