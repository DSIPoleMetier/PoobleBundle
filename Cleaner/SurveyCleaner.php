<?php

namespace Lyon1\Bundle\PoobleBundle\Cleaner;

use  Lyon1\Bundle\PoobleBundle\Entity\Survey;

class SurveyCleaner
{

    public function clean(Survey $survey)
    {
        if ($survey->getCategory()->getType() == "configure_choice") {
            return $survey;
        }
        foreach ($survey->getItems() as $item) {
            $decodedName=json_decode($item->getName(),true);
            $date=\DateTime::createFromFormat("Y-m-d h:i:s",$decodedName['date']);
            $item->setName($date->format("d/m/Y"));
        }
        return $survey;
    }
    


}