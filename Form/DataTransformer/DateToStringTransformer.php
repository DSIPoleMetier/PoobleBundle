<?php

namespace Lyon1\Bundle\PoobleBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class DateToStringTransformer implements DataTransformerInterface
{
    /**
     * Transforms a string to a object (datetime).
     *
     * @param  string $dateString
     * @return DateTime
     */
    public function reverseTransform($date)
    {
        return json_encode($date);
    }

    /**
     * Transforms an object (datetime) to a string.
     *
     * @param  DateTime $date
     * @return string
     */
    public function transform($date)
    {
        if (!$date) {
            return null;
        }

        return json_decode($date,true);
    }
}