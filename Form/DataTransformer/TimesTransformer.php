<?php

namespace Lyon1\Bundle\PoobleBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class TimesTransformer implements DataTransformerInterface
{
    /**
     * Transforms a string to a time[].
     *
     * @param  string $time
     * @return Array
     */
    public function reverseTransform($time)
    {
        return json_encode($time);        
    }

    /**
     * Transforms an object time[] to a string.
     *
     * @param  Array $times
     * @return string
     */
    public function transform($times)
    {
        return json_decode($times, true);
    }
}