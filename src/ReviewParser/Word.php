<?php

namespace App\ReviewParser;

use App\HotelAdjectives\Adjectives;
use App\HotelMdifiers\Modifiers;
use phpDocumentor\Reflection\Types\String_;
use App\HotelFeature\Feature;

class Word
{

    /** @var string $text The actual text */
    var $text;

    /** @var bool $isHotelFeature */
    var $isHotelFeature;

    /**
     * @var string[]
     */
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

        if (in_array($text, $feature->featureWords())) {
            return true;
        }
        return false;
    }

    public function checkForAdjective(string $text): bool
    {
        $text =  strtolower($text);

        $adjectives = new Adjectives();

        if (in_array($text, $adjectives->adjectivesWords())) {
            return true;
        }
        return false;
    }

    public function checkForModifier(string $text): bool
    {
        $text =  strtolower($text);

        $modifier = new Modifiers();

        if (in_array($text, $modifier->modifierWords())) {
            return true;
        }
        return false;
    }

}
