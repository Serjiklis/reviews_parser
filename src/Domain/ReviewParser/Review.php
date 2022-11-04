<?php

namespace App\Domain\ReviewParser;

class Review
{
    /** @var array<Word> $wordArray All lower case text */
    var $wordArray;

    /**
     * @param string $reviewText;
     */
    public function __construct(string $reviewText)
    {
        $this->wordArray = $this->parseWords($reviewText);
    }

    /**
     * @return int
     */
    public function wordCount()
    {
        return count($this->wordArray);
    }

    /**
     * @param string $reviewText
     * @return array<Word>
     */
    public function parseWords(string $reviewText) : array
    {
        $WordArray = [];
        foreach (explode(" ",$reviewText) as $text)
        {
            $Word = new Word($text);
            $WordArray[] = $Word;
        }

        return $WordArray;
    }
}
