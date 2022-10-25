<?php

namespace spec\App\ReviewParser;

use App\ReviewParser\Review;
use App\ReviewParser\Word;
use PhpSpec\ObjectBehavior;

class ReviewSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("Nice staff");
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Review::class);
    }

    function it_constructs_a_review_of_words()
    {
        $reviewText = "Nice staff";

        $this->beConstructedWith($reviewText);

        $this->wordCount()->shouldReturn(2);
    }

    function it_parses_words_correctly()
    {
        $wordArray = $this->parseWords("Hello everyone here");
        $wordArray[0]->text->shouldBe("Hello");
    }
}
