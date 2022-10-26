<?php

namespace spec\App\ReviewParser;

use App\ReviewParser\Word;
use PhpSpec\ObjectBehavior;

class WordSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("spa");
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Word::class);
    }

    function it_is_constructed_correctly()
    {
        $this->text->shouldBe("spa");
    }

    function it_detects_hotel_features()
    {
        $this->checkForHotelFeature("Spa")->shouldReturn(true);
        $this->checkForHotelFeature("spa")->shouldReturn(true);
        $this->checkForHotelFeature("amazing")->shouldReturn(false);
        $this->checkForHotelFeature("staff")->shouldReturn(true);
    }

    function it_detects_adjectives()
    {
        $this->checkForAdjective("amazing")->shouldReturn(true);
    }

    function it_detects_modifiers()
    {
        $this->checkForModifier("not")->shouldReturn(true);
    }

}
