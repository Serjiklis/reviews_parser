<?php

namespace spec\App\Domain\Entities;

use App\Domain\Entities\Review;
use App\Domain\ValueObjects\Word;
use PhpSpec\ObjectBehavior;

class ReviewSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith
        (
            [
                new Word("nice",Word::ADJECTIVE),
                new Word("staff",Word::FEATURE)
            ]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Review::class);
    }

    function it_constructs_a_review_of_words()
    {
       $this->wordCount()->shouldReturn(2);
    }

}
