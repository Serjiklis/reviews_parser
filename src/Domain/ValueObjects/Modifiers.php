<?php

namespace App\Domain\ValueObjects;

class Modifiers
{

    /**
     * @return string[]
     */
    function modifierWords(): array
    {
        return [
            "no",
            "not"
        ];
    }
}
