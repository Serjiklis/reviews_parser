<?php

namespace App\ReviewParser;

class Word
{

    /** @var string $text The actual text */
    var $text;

    /** @var bool $isHotelFeature */
    var $isHotelFeature;

    var $featureWords =
    [
        "spa",
        "staff"
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
        if($text=="spa")
            return true;
        
        return false;
    }
}
