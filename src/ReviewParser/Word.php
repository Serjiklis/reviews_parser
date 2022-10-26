<?php

namespace App\ReviewParser;

use phpDocumentor\Reflection\Types\String_;
use App\HotelFeature\Feature;

class Word
{

    /** @var string $text The actual text */
    var $text;

    /** @var bool $isHotelFeature */
    var $isHotelFeature;
    
    var $checkForAdjectives =
        [
            "amazing",
            "poor",
            "helpful"
        ];
    var $modifiers =
        [
            "no",
            "not"
        ];

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
        $this->isHotelFeature = $this->checkForHotelFeature($text);
    }



    function checkForHotelFeature(string $text) : bool
    {
        $text =  strtolower($text);

        $feature = new Feature();

        foreach ($feature->featureWords() as $word)
        {
            if($word == $text)
            {
                return true;
            }
        }
        return false;
    }

    public function checkForAdjective(string $text): bool
    {
        $text =  strtolower($text);
        foreach ($this->checkForAdjectives as $adjective)
        {
            if($adjective == $text)
            {
                return true;
            }
        }
        return false;
    }

    public function checkForModifier(string $text): bool
    {
        $text =  strtolower($text);
        foreach ($this->modifiers as $modifier)
        {
            if($modifier == $text)
            {
                return true;
            }
        }
        return false;
    }

}
