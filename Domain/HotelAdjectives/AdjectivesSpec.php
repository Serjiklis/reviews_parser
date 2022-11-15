<?php

namespace spec\App\Domain\HotelAdjectives;

use App\Domain\ValueObjects\Adjectives;
use PhpSpec\ObjectBehavior;

class AdjectivesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Adjectives::class);
    }

    function it_hotel_adjectiv_should_be_array()
    {
        $this->adjectivesWords()->shouldBeArray();
    }

}
