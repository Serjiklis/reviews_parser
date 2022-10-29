<?php

namespace spec\App\HotelMdifiers;

use App\HotelMdifiers\Modifiers;
use PhpSpec\ObjectBehavior;

class ModifiersSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Modifiers::class);
    }

    function it_hotel_modifier_should_be_array()
    {
        $this->modifierWords()->shouldBeArray();
    }
}
