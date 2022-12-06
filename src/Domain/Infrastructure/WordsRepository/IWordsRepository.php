<?php

namespace App\Domain\Infrastructure\WordsRepository;

use App\Domain\ValueObjects\Word;

interface IWordsRepository
{
    /**
     * @param string $text
     * @return ?Word
     */
    public function lookupWord(string $text) : ?Word;
}