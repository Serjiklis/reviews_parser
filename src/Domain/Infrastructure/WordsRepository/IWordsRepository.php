<?php

namespace App\Infrastructure\WordsRepository;

use App\Domain\ValueObjects\Word;

interface IWordsRepository
{
    /**
     * @param string $type
     * @return array<Word>
     */
    public function getWordsByType(string $type) : array;
}