<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Word;
use App\Domain\Infrastructure\WordsRepository\IWordsRepository;

class Review
{
    /** @var IWordsRepository $WordsRepository */
    var $WordsRepository;
    
    /** @var array<Word> $wordArray All lower case text */
    var $wordArray;

    /**
     * @param array<Word> $wordArray
     */
    public function __construct(array $wordArray)
    {
        $this->wordArray = $wordArray;
    }

    /**
     * @return int
     */
    public function wordCount()
    {
        return count($this->wordArray);
    }


    /**
     * @return array<mixed>
     */
    public function getReviewResults() : array
    {
        return (array) $this;
    }
}
