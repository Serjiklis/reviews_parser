<?php

namespace spec\App;

use App\Word;
use PhpSpec\ObjectBehavior;

class WordSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Word::class);
    }
}
