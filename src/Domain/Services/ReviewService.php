<?php

namespace App\Domain\Services;

use App\Domain\Entities\Review;
use App\Domain\ValueObjects\Word;
use App\Domain\Infrastructure\WordsRepository\IWordsRepository;

class ReviewService implements IReviewService
{
    /** @var IWordsRepository $WordsRepository */
    var $WordsRepository;

    function __construct(IWordsRepository $WordsRepository)
    {
        $this->WordsRepository = $WordsRepository;
    }

    /**
     * @param string $reviewText
     * @return array<mixed>
     */
    function parseReview(string $reviewText) : array
    {
        $wordArray = $this->parseWords($reviewText);
        $Review = new Review($wordArray);
        return $Review->getReviewResults();
    }

     /**
     * @param string $reviewText
     * @return array<Word>
     */
    public function parseWords(string $reviewText) : array
    {
        $WordArray = [];
        foreach (explode(" ", $reviewText) as $text)
        {
            $Word = $this->WordsRepository->lookupWord($text);
            $WordArray[] = $Word;
        }

        return $WordArray;
    }
}