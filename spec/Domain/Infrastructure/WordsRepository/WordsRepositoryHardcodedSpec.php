<?php

namespace spec\App\Domain\Infrastructure\WordsRepository;

use App\Domain\Infrastructure\WordsRepository\WordsRepositoryHardcoded;
use PhpSpec\ObjectBehavior;

class WordsRepositoryHardcodedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(WordsRepositoryHardcoded::class);
    }
}
