<?php

namespace App\Domain\Infrastructure\WordsRepository;

use App\Domain\ValueObjects\Word;

class WordsRepositoryHardcoded implements IWordsRepository
{
    /**
     * {@inheritdoc}
     */
    public function getWordsByType(int $wordType) : array
    {
        $wordsArray = [];
        if($wordType==Word::ADJECTIVE)
        {
            foreach($this->adjectivesWords() as $wordString)
            {
                $wordsArray[] = new Word($wordString,Word::ADJECTIVE);
            }
        }

        else if($wordType==Word::FEATURE)
        {
            foreach($this->featureWords() as $wordString)
            {
                $wordsArray[] = new Word($wordString,Word::FEATURE);
            }
        }
        else if($wordType==Word::MODIFIER)
        {
            foreach($this->modifierWords() as $wordString)
            {
                $wordsArray[] = new Word($wordString, Word::MODIFIER);
            }
        }
        else throw new \Exception("Unknown lexicon type ".$wordType);

        return $wordsArray;
    }

    /**
     * {@inheritdoc}
     */
    public function lookupWord(string $text) : Word
    {
        foreach(Word::getTypes() as $wordType)
        {
            $wordsArray = $this->getWordsByType($wordType);
            foreach($wordsArray as $Word)
            {
                if($Word->hasText($text))
                    return $Word;
            }
        }

        return new Word($text);
    }

    /**
     * @return string[]
     */
    private function adjectivesWords(): array
    {
        return [
            "amazing",
            "poor",
            "helpful",
            "nice"
        ];
    }

    /**
     * @return string[]
     */
    private function featureWords(): array
    {
        return [
            "spa",
            "staff",
            "pet-friendly",
            "fitness centre"
        ];
    }

    /**
     * @return string[]
     */
    private function modifierWords(): array
    {
        return [
            "no",
            "not"
        ];
    }
}