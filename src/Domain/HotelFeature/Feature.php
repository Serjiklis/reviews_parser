<?php

namespace App\Domain\HotelFeature;

class Feature
{

    /**
     * @return string[]
     */
    function featureWords(): array
    {
        return [
            "spa",
            "staff",
            "pet-friendly",
            "fitness centre"
        ];
    }
}
