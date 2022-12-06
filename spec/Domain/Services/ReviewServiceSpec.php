<?php

namespace spec\App\Domain\Services;

use App\Domain\Infrastructure\WordsRepository\IWordsRepository;
use App\Domain\Services\ReviewService;
use App\Domain\ValueObjects\Word;
use PhpSpec\ObjectBehavior;

class ReviewServiceSpec extends ObjectBehavior
{
    function let(IWordsRepository $WordsRepository)
    {
        $this->beConstructedWith($WordsRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ReviewService::class);
    }

    function it_parses_reviews(IWordsRepository $WordsRepository)
    {
        $WordsRepository->lookupWord("horrible")->willReturn(new Word("horrible",Word::ADJECTIVE));
        $WordsRepository->lookupWord("spa")->willReturn(new Word("spa",Word::FEATURE));
        $this->beConstructedWith($WordsRepository);
        $wordsArray = $this->parseWords("horrible spa");
        
        $wordsArray[0]->text->shouldBe("horrible");
        $wordsArray[1]->text->shouldBe("spa");
        $wordsArray[1]->type->shouldBe(Word::FEATURE);
    }
}
