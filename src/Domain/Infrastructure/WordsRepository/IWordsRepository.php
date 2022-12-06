<?php

namespace App\Domain\Infrastructure\WordsRepository;

use App\Domain\ValueObjects\Word;

interface IWordsRepository
{
    /**
     * @param int $wordType
     * @return array<Word>
     */
    public function getWordsByType(int $wordType) : array;

    /**
     * @param string $text
     * @return ?Word
     */
    public function lookupWord(string $text) : ?Word;
}