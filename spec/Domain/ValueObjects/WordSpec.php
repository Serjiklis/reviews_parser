<?php

namespace spec\App\Domain\ValueObjects;

use App\Domain\ValueObjects\Word;
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

 

}
