<?php

namespace App\Domain\ValueObjects;



class Word
{

    /** @var string $text The actual text */
    var $text;

    /** @var bool $isHotelFeature */
    var $isHotelFeature;

    /** @var bool $isAdjective */
    var $isAdjective;

    /** @var bool $isModifier */
    var $isModifier;

    /** @var int $type */
    var $type;

    const UNKNOWN=0;
    const FEATURE=1;
    const ADJECTIVE=2;
    const MODIFIER=3;

    /**
     * @param string $text
     */
    public function __construct(string $text, int $type=self::UNKNOWN)
    {
        $this->text = self::simplify($text);
        $this->type = $type;
    }

    /**
     * @return array<int>
     */
    static function getTypes() : array
    {
        return [self::FEATURE,self::ADJECTIVE,self::MODIFIER];
    }

    function hasText(string $text) : bool
    {
        return self::simplify($text) == $this->text;
    }

    function simplify(string $text) : string
    {
        return trim(strtolower($text));
    }
}
