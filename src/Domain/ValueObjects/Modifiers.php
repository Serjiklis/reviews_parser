<?php

namespace App\Domain\ValueObjects;

class Modifiers implements IList
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
