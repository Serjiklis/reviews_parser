<?php

namespace App\Domain\ValueObjects;

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
